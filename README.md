[![Build Status](https://travis-ci.org/eddiejaoude/symfony-translation-twig-collection-bundle.svg)](https://travis-ci.org/eddiejaoude/symfony-translation-twig-collection-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/eddiejaoude/symfony-translation-twig-collection-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/eddiejaoude/symfony-translation-twig-collection-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/eddiejaoude/symfony-translation-twig-collection-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/eddiejaoude/symfony-translation-twig-collection-bundle/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/eddiejaoude/eddie-jaoude-symfony-translation-twig-collection-bundle/v/stable.svg)](https://packagist.org/packages/eddiejaoude/eddie-jaoude-symfony-translation-twig-collection-bundle) 
[![Total Downloads](https://poser.pugx.org/eddiejaoude/eddie-jaoude-symfony-translation-twig-collection-bundle/downloads.svg)](https://packagist.org/packages/eddiejaoude/eddie-jaoude-symfony-translation-twig-collection-bundle) 
[![Latest Unstable Version](https://poser.pugx.org/eddiejaoude/eddie-jaoude-symfony-translation-twig-collection-bundle/v/unstable.svg)](https://packagist.org/packages/eddiejaoude/eddie-jaoude-symfony-translation-twig-collection-bundle) 
[![License](https://poser.pugx.org/eddiejaoude/eddie-jaoude-symfony-translation-twig-collection-bundle/license.svg)](https://packagist.org/packages/eddiejaoude/eddie-jaoude-symfony-translation-twig-collection-bundle)

[![DashboardHub Badge](http://dashboardhub.io/badge/551f61ab1d8852.10987203 "DashboardHub Badge")](http://dashboardhub.io/d/551f61ab1d8852.10987203)

## Symfony Translation Twig Collection Bundle
Symfony Translation Bundle for Twig Extension to handle collection

| Version | Branch | Latest Release | 
| ------- | ------ | -------------- |
| Symfony 2.2+ | 2.2 | v2.2.0 |
| Symfony 2.6+ | 2.6 | v2.6.0 |

### Installation

1. Composer

```
   "require": {
       "eddiejaoude/eddie-jaoude-symfony-translation-twig-collection-bundle": "dev-master"
   }
```

2. Run update

```
php composer.phar update
```

3. Add to **AppKernel**

```php
   $bundles = array(
   // ...
   new EddieJaoude\Bundle\SymfonyTranslationTwigCollectionBundle\EddieJaoudeSymfonyTranslationTwigCollectionBundle(),
   // ...
   )
```

### Usage

Translation file (eg. `messages.en.yml`)

```
termsAndConditions:
  title: Terms and Conditions
  paragraph:
    - Terms Information 1
    - Terms Information 2
    - Terms Information 3
    - Terms Information 4
    ...
```

Twig template (eg. `index.html.twig`)

```
{% for i in range(0,'termsAndConditions.paragraph'|translationLength) -%}
    <p>{{('termsAndConditions.paragraph.'~i)|trans}}</p>
{%- endfor %}
```

Output

```
Terms Information 1
Terms Information 2
Terms Information 3
Terms Information 4
```

### Credits

Inspired by **acontell** http://stackoverflow.com/questions/27868921/symfony2-translation-yaml-array-and-twig-loop
