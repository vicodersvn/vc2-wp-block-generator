import { Rule, chain, apply, url, move, mergeWith, applyTemplates, filter, noop } from '@angular-devkit/schematics';
import { strings } from '@angular-devkit/core';
import * as path from 'path';
import { appendTo } from './utility/append-to-file/append-to-file';
import packageIntall from './utility/package-install';

export default function handler(options: any): Rule {
  const templateSource = apply(url('./files/slider'), [
    options.skipTests ? filter(path => !path.endsWith('.spec.ts.template')) : noop(),
    applyTemplates({
      ...strings,
      ...options
    }),
    move(options.path)
  ]);
  const block_js_file_path = path.resolve(process.cwd(), 'resources', 'assets', 'scripts', 'blocks', 'index.js');
  return chain([mergeWith(templateSource), appendTo(block_js_file_path, "import './slider'"), packageIntall({ packageName: 'slick-carousel' })]);
}
