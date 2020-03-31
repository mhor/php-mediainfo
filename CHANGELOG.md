# Changelog

## [5.0.0](https://github.com/mhor/php-mediainfo/tree/5.0.0) (2020-03-31)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/4.1.3...5.0.0)

**Closed issues:**

- Process does not work on Windows / wrong ENV-definition [\#106](https://github.com/mhor/php-mediainfo/issues/106)
- Remove compatibility layers [\#99](https://github.com/mhor/php-mediainfo/issues/99)
- Only support new version of mediainfo [\#98](https://github.com/mhor/php-mediainfo/issues/98)
- Convert code to php7 [\#97](https://github.com/mhor/php-mediainfo/issues/97)
- Update dependencies [\#96](https://github.com/mhor/php-mediainfo/issues/96)

**Merged pull requests:**

- Use mediainfo\>=17.10 output format by default [\#103](https://github.com/mhor/php-mediainfo/pull/103) ([mhor](https://github.com/mhor))
- phpunit: migrate getMock usage to prophecy [\#102](https://github.com/mhor/php-mediainfo/pull/102) ([mhor](https://github.com/mhor))
- PHP 7.4 support [\#101](https://github.com/mhor/php-mediainfo/pull/101) ([mhor](https://github.com/mhor))
- Update php code [\#109](https://github.com/mhor/php-mediainfo/pull/109) ([mhor](https://github.com/mhor))
- Update symfony/process component call [\#108](https://github.com/mhor/php-mediainfo/pull/108) ([mhor](https://github.com/mhor))

## [4.1.3](https://github.com/mhor/php-mediainfo/tree/4.1.3) (2020-03-22)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/4.1.2...4.1.3)

**Fixed bugs:**

- Runtime exception for version 4.1.1 due to latest fix - Wrap every command argument in quotes [\#87](https://github.com/mhor/php-mediainfo/issues/87)

**Merged pull requests:**

- Update MediaInfoCommandRunner.php [\#107](https://github.com/mhor/php-mediainfo/pull/107) ([cklm](https://github.com/cklm))
- Update TravisCI configuration [\#94](https://github.com/mhor/php-mediainfo/pull/94) ([mhor](https://github.com/mhor))

## [4.1.2](https://github.com/mhor/php-mediainfo/tree/4.1.2) (2018-07-03)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/4.1.1...4.1.2)

## [4.1.1](https://github.com/mhor/php-mediainfo/tree/4.1.1) (2018-06-27)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/4.1.0...4.1.1)

**Fixed bugs:**

- Mediainfo \>= 17.10 changed XML Format [\#82](https://github.com/mhor/php-mediainfo/issues/82)
- XML format of mediainfo command has changed [\#76](https://github.com/mhor/php-mediainfo/issues/76)
- Wrap every command argument in quotes [\#86](https://github.com/mhor/php-mediainfo/pull/86) ([mitchellklijs](https://github.com/mitchellklijs))

## [4.1.0](https://github.com/mhor/php-mediainfo/tree/4.1.0) (2018-04-08)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/4.0.2...4.1.0)

**Fixed bugs:**

- Add conf to support new versions of mediainfo [\#84](https://github.com/mhor/php-mediainfo/pull/84) ([mhor](https://github.com/mhor))

**Closed issues:**

- Laravel 5.6 support [\#85](https://github.com/mhor/php-mediainfo/issues/85)

**Merged pull requests:**

- Fix-Runtime exception for version 4.1.1 [\#88](https://github.com/mhor/php-mediainfo/pull/88) ([amardeokar23](https://github.com/amardeokar23))

## [4.0.2](https://github.com/mhor/php-mediainfo/tree/4.0.2) (2017-12-21)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/4.0.1...4.0.2)

**Fixed bugs:**

- core: fix broken runner, as process input does not work as expected [\#81](https://github.com/mhor/php-mediainfo/pull/81) ([fvilpoix](https://github.com/fvilpoix))

## [4.0.1](https://github.com/mhor/php-mediainfo/tree/4.0.1) (2017-12-19)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/4.0.0...4.0.1)

**Implemented enhancements:**

- Support for Symfony 4 components [\#77](https://github.com/mhor/php-mediainfo/issues/77)

**Merged pull requests:**

- Typo on composer.json, allow any version of symfony component 4.0.\* [\#80](https://github.com/mhor/php-mediainfo/pull/80) ([fvilpoix](https://github.com/fvilpoix))

## [4.0.0](https://github.com/mhor/php-mediainfo/tree/4.0.0) (2017-12-15)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/3.0.0...4.0.0)

**Closed issues:**

- Unicode filename fail [\#72](https://github.com/mhor/php-mediainfo/issues/72)
- Migrate to array short syntax [\#69](https://github.com/mhor/php-mediainfo/issues/69)
- use url for path to media file [\#59](https://github.com/mhor/php-mediainfo/issues/59)

**Merged pull requests:**

- Apply fixes from StyleCI [\#79](https://github.com/mhor/php-mediainfo/pull/79) ([mhor](https://github.com/mhor))
- Allow compatibility with symfony4 components [\#78](https://github.com/mhor/php-mediainfo/pull/78) ([fvilpoix](https://github.com/fvilpoix))
- Update README.md [\#75](https://github.com/mhor/php-mediainfo/pull/75) ([cklm](https://github.com/cklm))
- I guess it's still accurate but must be specified [\#74](https://github.com/mhor/php-mediainfo/pull/74) ([Nek-](https://github.com/Nek-))
- change StyleCI config [\#70](https://github.com/mhor/php-mediainfo/pull/70) ([mhor](https://github.com/mhor))

## [3.0.0](https://github.com/mhor/php-mediainfo/tree/3.0.0) (2017-01-17)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/2.3.1...3.0.0)

**Fixed bugs:**

- Rate::getAbsoluteValue\(\) returns a string [\#65](https://github.com/mhor/php-mediainfo/issues/65)

**Closed issues:**

- Height is expressed as a Rate [\#67](https://github.com/mhor/php-mediainfo/issues/67)

**Merged pull requests:**

- add Ratio attribute type [\#68](https://github.com/mhor/php-mediainfo/pull/68) ([mhor](https://github.com/mhor))

## [2.3.1](https://github.com/mhor/php-mediainfo/tree/2.3.1) (2017-01-15)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/2.3.0...2.3.1)

**Merged pull requests:**

- Fix attributes type [\#66](https://github.com/mhor/php-mediainfo/pull/66) ([mhor](https://github.com/mhor))

## [2.3.0](https://github.com/mhor/php-mediainfo/tree/2.3.0) (2017-01-13)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/2.2.2...2.3.0)

**Merged pull requests:**

- Improve exception messages [\#64](https://github.com/mhor/php-mediainfo/pull/64) ([greg0ire](https://github.com/greg0ire))

## [2.2.2](https://github.com/mhor/php-mediainfo/tree/2.2.2) (2016-09-04)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/2.2.1...2.2.2)

**Fixed bugs:**

- Encoding issues related to simplexml\_load\_string [\#60](https://github.com/mhor/php-mediainfo/issues/60)

**Merged pull requests:**

- Check if isset [\#62](https://github.com/mhor/php-mediainfo/pull/62) ([danog](https://github.com/danog))

## [2.2.1](https://github.com/mhor/php-mediainfo/tree/2.2.1) (2016-07-11)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/2.2.0...2.2.1)

## [2.2.0](https://github.com/mhor/php-mediainfo/tree/2.2.0) (2016-05-22)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/2.1.0...2.2.0)

**Implemented enhancements:**

- Remote file Support [\#55](https://github.com/mhor/php-mediainfo/issues/55)
- make MediaInfoContainer dumpable [\#34](https://github.com/mhor/php-mediainfo/issues/34)

**Merged pull requests:**

- Simplify build [\#58](https://github.com/mhor/php-mediainfo/pull/58) ([mhor](https://github.com/mhor))
- Use url as file path [\#56](https://github.com/mhor/php-mediainfo/pull/56) ([mhor](https://github.com/mhor))

## [2.1.0](https://github.com/mhor/php-mediainfo/tree/2.1.0) (2016-05-06)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/2.0.0...2.1.0)

**Merged pull requests:**

- Applied fixes from StyleCI [\#54](https://github.com/mhor/php-mediainfo/pull/54) ([mhor](https://github.com/mhor))
- \[Travis\] disable XDebug [\#53](https://github.com/mhor/php-mediainfo/pull/53) ([mhor](https://github.com/mhor))
- mediainfocontainer-dump-xml [\#52](https://github.com/mhor/php-mediainfo/pull/52) ([javiertrejo](https://github.com/javiertrejo))

## [2.0.0](https://github.com/mhor/php-mediainfo/tree/2.0.0) (2016-05-02)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.6.0...2.0.0)

**Merged pull requests:**

- Applied fixes from StyleCI [\#51](https://github.com/mhor/php-mediainfo/pull/51) ([mhor](https://github.com/mhor))
- Feature/mediainfocontainer dump [\#50](https://github.com/mhor/php-mediainfo/pull/50) ([javiertrejo](https://github.com/javiertrejo))

## [1.6.0](https://github.com/mhor/php-mediainfo/tree/1.6.0) (2016-01-24)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.5.3...1.6.0)

**Fixed bugs:**

- Warning: escapeshellarg\(\) expects parameter 1 to be string, array given \(...\) [\#45](https://github.com/mhor/php-mediainfo/issues/45)
- Encoding [\#42](https://github.com/mhor/php-mediainfo/issues/42)

**Merged pull requests:**

- Make php-mediainfo more configurable [\#47](https://github.com/mhor/php-mediainfo/pull/47) ([mhor](https://github.com/mhor))
- fix symfony2.3 compatibility [\#46](https://github.com/mhor/php-mediainfo/pull/46) ([mhor](https://github.com/mhor))

## [1.5.3](https://github.com/mhor/php-mediainfo/tree/1.5.3) (2015-12-21)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.5.2...1.5.3)

## [1.5.2](https://github.com/mhor/php-mediainfo/tree/1.5.2) (2015-12-21)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.5.1...1.5.2)

**Merged pull requests:**

- Added lc\_type env to travis test [\#44](https://github.com/mhor/php-mediainfo/pull/44) ([alangregory](https://github.com/alangregory))
- tweaked .travis.yml [\#41](https://github.com/mhor/php-mediainfo/pull/41) ([mhor](https://github.com/mhor))
- improve unit test [\#40](https://github.com/mhor/php-mediainfo/pull/40) ([mhor](https://github.com/mhor))

## [1.5.1](https://github.com/mhor/php-mediainfo/tree/1.5.1) (2015-12-04)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.5.0...1.5.1)

**Merged pull requests:**

- Set LANG env variable [\#43](https://github.com/mhor/php-mediainfo/pull/43) ([alangregory](https://github.com/alangregory))
- make php-mediainfo compatible with symfony3 [\#39](https://github.com/mhor/php-mediainfo/pull/39) ([mhor](https://github.com/mhor))
- Dedup attributes with different case [\#38](https://github.com/mhor/php-mediainfo/pull/38) ([mhor](https://github.com/mhor))
- fix .styleci.yml [\#37](https://github.com/mhor/php-mediainfo/pull/37) ([mhor](https://github.com/mhor))

## [1.5.0](https://github.com/mhor/php-mediainfo/tree/1.5.0) (2015-09-16)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.4.4...1.5.0)

**Fixed bugs:**

- Type doesn't exist: Menu [\#31](https://github.com/mhor/php-mediainfo/issues/31)

**Merged pull requests:**

- Add Menu type [\#32](https://github.com/mhor/php-mediainfo/pull/32) ([mhor](https://github.com/mhor))

## [1.4.4](https://github.com/mhor/php-mediainfo/tree/1.4.4) (2015-09-04)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.4.3...1.4.4)

**Implemented enhancements:**

- What about adding 'Maximum bit rate'? [\#29](https://github.com/mhor/php-mediainfo/issues/29)

**Merged pull requests:**

- Add maximum\_bit\_rate [\#30](https://github.com/mhor/php-mediainfo/pull/30) ([mhor](https://github.com/mhor))

## [1.4.3](https://github.com/mhor/php-mediainfo/tree/1.4.3) (2015-09-02)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.4.2...1.4.3)

**Fixed bugs:**

- if Video, Audio Track-\>format is string, value is invalid. [\#27](https://github.com/mhor/php-mediainfo/issues/27)

**Closed issues:**

- Fix StyleCI build [\#25](https://github.com/mhor/php-mediainfo/issues/25)

**Merged pull requests:**

- Some Mode field can be strings [\#28](https://github.com/mhor/php-mediainfo/pull/28) ([mhor](https://github.com/mhor))
- Fixed styleci config [\#26](https://github.com/mhor/php-mediainfo/pull/26) ([GrahamCampbell](https://github.com/GrahamCampbell))

## [1.4.2](https://github.com/mhor/php-mediainfo/tree/1.4.2) (2015-07-08)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.4.1...1.4.2)

## [1.4.1](https://github.com/mhor/php-mediainfo/tree/1.4.1) (2015-06-14)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.4.0...1.4.1)

**Merged pull requests:**

- Typo fixes [\#24](https://github.com/mhor/php-mediainfo/pull/24) ([GrahamCampbell](https://github.com/GrahamCampbell))
- Fixes [\#23](https://github.com/mhor/php-mediainfo/pull/23) ([GrahamCampbell](https://github.com/GrahamCampbell))
- Fixed style to match the other badges [\#20](https://github.com/mhor/php-mediainfo/pull/20) ([GrahamCampbell](https://github.com/GrahamCampbell))

## [1.4.0](https://github.com/mhor/php-mediainfo/tree/1.4.0) (2015-06-14)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.3.0...1.4.0)

**Merged pull requests:**

- Async operations [\#19](https://github.com/mhor/php-mediainfo/pull/19) ([Nicholi](https://github.com/Nicholi))

## [1.3.0](https://github.com/mhor/php-mediainfo/tree/1.3.0) (2015-06-13)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.2.1...1.3.0)

**Merged pull requests:**

- Optionally Ignore unknown TrackTypes [\#18](https://github.com/mhor/php-mediainfo/pull/18) ([Nicholi](https://github.com/Nicholi))

## [1.2.1](https://github.com/mhor/php-mediainfo/tree/1.2.1) (2015-03-12)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.2.0...1.2.1)

## [1.2.0](https://github.com/mhor/php-mediainfo/tree/1.2.0) (2015-01-25)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1.0.0...1.2.0)

**Implemented enhancements:**

- Support subtitles [\#15](https://github.com/mhor/php-mediainfo/issues/15)
- Implement \_\_toString for custom type [\#13](https://github.com/mhor/php-mediainfo/issues/13)

**Closed issues:**

- - [\#14](https://github.com/mhor/php-mediainfo/issues/14)

**Merged pull requests:**

- Add Subtitle type [\#17](https://github.com/mhor/php-mediainfo/pull/17) ([mhor](https://github.com/mhor))
- add \_\_toString function on attributes fix \#13 [\#16](https://github.com/mhor/php-mediainfo/pull/16) ([mhor](https://github.com/mhor))
- add documentation [\#12](https://github.com/mhor/php-mediainfo/pull/12) ([mhor](https://github.com/mhor))

## [1.0.0](https://github.com/mhor/php-mediainfo/tree/1.0.0) (2014-12-14)

[Full Changelog](https://github.com/mhor/php-mediainfo/compare/1854a9f02a9e71880afdaa908ff77c01ecdef920...1.0.0)

**Merged pull requests:**

- add special type fields [\#11](https://github.com/mhor/php-mediainfo/pull/11) ([mhor](https://github.com/mhor))
- Increase code coverage [\#10](https://github.com/mhor/php-mediainfo/pull/10) ([mhor](https://github.com/mhor))
- Create attribute name checker [\#9](https://github.com/mhor/php-mediainfo/pull/9) ([mhor](https://github.com/mhor))
- Architecture enhancement [\#8](https://github.com/mhor/php-mediainfo/pull/8) ([mhor](https://github.com/mhor))
- add badges [\#7](https://github.com/mhor/php-mediainfo/pull/7) ([mhor](https://github.com/mhor))
- cs fix [\#6](https://github.com/mhor/php-mediainfo/pull/6) ([mhor](https://github.com/mhor))
- architecture improvement + unit tests + cs fix [\#5](https://github.com/mhor/php-mediainfo/pull/5) ([mhor](https://github.com/mhor))
- cleaning [\#4](https://github.com/mhor/php-mediainfo/pull/4) ([mhor](https://github.com/mhor))
- cleaning cs docs [\#3](https://github.com/mhor/php-mediainfo/pull/3) ([mhor](https://github.com/mhor))
- create custom attribute for special values [\#2](https://github.com/mhor/php-mediainfo/pull/2) ([mhor](https://github.com/mhor))
- create attribute factories [\#1](https://github.com/mhor/php-mediainfo/pull/1) ([mhor](https://github.com/mhor))



\* *This Changelog was automatically generated by [github_changelog_generator](https://github.com/github-changelog-generator/github-changelog-generator)*
