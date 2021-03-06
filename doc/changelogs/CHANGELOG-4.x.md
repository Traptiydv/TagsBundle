Netgen Tags Bundle 4.x changelog
================================

4.0.1 (21.04.2020)
------------------

* Support using Tag object with `ez_url` / `ez_path` Twig functions

4.0.0 (14.04.2020)
------------------

Since 4.0 is a new major release, there were a number of breaking changes, so be sure to read [upgrade instructions](UPGRADE.md#upgrade-from-34-to-40).

The following lists only the most important changes from version 3.4 to version 4.0:

* Minimum supported version of PHP is now PHP 7.3
* Minimum supported version of eZ Platform is now 3.0
* The codebase has been modernized across the board:
    - The entire code base is migrated to PHP 7 style code (scalar and return typehints, strict type checking)
    - Most of the classes are now `final`. Use composition to extend the functionality of the bundle
