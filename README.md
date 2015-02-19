#[Elusive Icons v2.0.0](http://elusiveicons.com)
###The iconic font and CSS framework

Elusive Icons is a full suite of 304 pictographic icons for easy scalable vector graphics on websites,
created and maintained by [Team Redux](http://twitter.com/ReduxFramework).
Stay up to date with the latest release and announcements on Twitter:
[@reduxframework](http://twitter.com/reduxframework).

Get started at http://elusiveicons.com!

##License
- The Elusive Icons font is licensed under the SIL OFL 1.1:
  - http://scripts.sil.org/OFL
- Elusive Icons CSS, LESS, and Sass files are licensed under the MIT License:
  - http://opensource.org/licenses/mit-license.html
- The Elusive Icons documentation is licensed under the CC BY 3.0 License:
  - http://creativecommons.org/licenses/by/3.0/
- Attribution is no longer required as of Elusive Icons 3.0, but much appreciated:
  - `Elusive Icons by Dave Gandy - http://elusiveicons.com`
- Full details: http://elusiveicons.com/license

##Changelog
- v2.0.0 - Complete icon rebuild.

## Contributing

Please read through our [contributing guidelines](https://github.com/ReduxFramework/Elusive-Icons/blob/master/CONTRIBUTING.md).
Included are directions for opening issues, coding standards, and notes on development.

##Versioning

Elusive Icons will be maintained under the Semantic Versioning guidelines as much as possible. Releases will be numbered
with the following format:

`<major>.<minor>.<patch>`

And constructed with the following guidelines:

* Breaking backward compatibility bumps the major (and resets the minor and patch)
* New additions, including new icons, without breaking backward compatibility bumps the minor (and resets the patch)
* Bug fixes and misc changes bumps the patch

For more information on SemVer, please visit http://semver.org.

##Author
- Email: elusive@redux.io
- Twitter: http://twitter.com/ReduxFramework
- GitHub: https://github.com/reduxframework

##Component
To include as a [component](http://github.com/component/component), just run

    $ component install ReduxFramework/Elusive-Icons

Or add

    "ReduxFramework/Elusive-Icons": "*"

to the `dependencies` in your `component.json`.

## Hacking on Elusive Icons

From the root of the repository, install the tools used to develop.

    $ bundle install
    $ npm install

Build the project and documentation:

    $ bundle exec jekyll build

Or serve it on a local server on http://localhost:7998/Elusive-Icons/:

    $ bundle exec jekyll -w serve
