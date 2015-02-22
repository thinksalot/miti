# Miti
Miti is a simple PHP library for datetime & datetime range comparisons.

[![Build Status](https://travis-ci.org/thinksalot/miti.svg?branch=master)](https://travis-ci.org/thinksalot/miti)

# Loading
Either using `require` in your app:

```php
require_once( '/path/to/Miti/src/autoload.php' );
```

or using [composer](https://getcomposer.org/):

```json
  "require": {
      "thinksalot/miti" : "*"
  }
```

# Usage

### Between
Checks if a date object lies between given dates

```php
$dt = new Miti\DateTime( '2015-02-22' );
$dt->between( '2015-01-01', '2015-03-01' );
```

### Contains
Checks if a range contains a date

```php
$dr = new Miti\DateTimeRange( '2015-01-01', '2015-03-01' );
$dr->contains( '2015-02-22' );
```

### Equals
Checks if two datetime ranges are the same

```php
$firstRange  = new Miti\DateTimeRange( '2015-01-01', '2015-03-01' );
$secondRange = new Miti\DateTimeRange( '2015-01-01', '2015-03-01' );
$firstRange->equals( $secondRange );
```
### Overlaps
Checks if two datetime ranges are overlapping

```php
$firstRange  = new Miti\DateTimeRange( '2015-01-01', '2015-03-01' );
$secondRange = new Miti\DateTimeRange( '2015-02-22', '2015-03-01' );
$firstRange->overlaps( $secondRange );
```
### Encloses
Checks if a datetime range encloses another

```php
$firstRange  = new Miti\DateTimeRange( '2015-01-01', '2015-06-01' );
$secondRange = new Miti\DateTimeRange( '2015-03-22', '2015-04-01' );
$firstRange->encloses( $secondRange );
```

### Consecutive to
Checks is a given range immediately follows another range

```php
$firstRange  = new Miti\DateTimeRange( '2015-01-01', '2015-06-01' );
$secondRange = new Miti\DateTimeRange( '2015-06-02', '2015-12-01' );
$secondRange->consecutiveTo( $firstRange );
```

# License
Please check the LICENSE file
