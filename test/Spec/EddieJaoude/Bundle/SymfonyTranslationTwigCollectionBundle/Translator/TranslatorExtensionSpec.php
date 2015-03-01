<?php

namespace Spec\EddieJaoude\Bundle\SymfonyTranslationTwigCollectionBundle\Translator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Loader\ArrayLoader;
use EddieJaoude\Bundle\SymfonyTranslationTwigCollectionBundle\Translator\TranslatorExtension as Translator;
/*
* This PHPspec class is partially inspired by the PHPUnit class written by Grygir.
* It aims at testing the getMessages() method of the TranslatorExtension class.
* It was written by x0s to ensure code coverage
*/
class TranslatorExtensionSpec extends ObjectBehavior
{

	function let(ContainerInterface $container, MessageSelector $selector)
	{
		$this->beConstructedWith($container, $selector);
	}

	function it_is_initializable()
	{
		$this->shouldHaveType('EddieJaoude\Bundle\SymfonyTranslationTwigCollectionBundle\Translator\TranslatorExtension');
	}


	function it_gets_the_messages(Translator $translator)
	{
		// We define the input data ($resources, $localeArray) and the expected behaviour ($expectedResult) for 4 scenarii
		$expectedEN = array(
					'jsmessages' => array(
						'foo' => 'foo (EN)',
						'bar' => 'bar (EN)',
					),
					'messages' => array(
						'foo' => 'foo messages (EN)',
					),
					'validators' => array(
						'int' => 'integer (EN)',
					)
		);
		$expectedPT = array(
					'jsmessages' => array(
						'foo' => 'foo (EN)',
						'bar' => 'bar (EN)',
					),
					'messages' => array(
						'foo' => 'foo messages (PT)',
					),
					'validators' => array(
						'int' => 'integer (EN)',
						'str' => 'integer (PT)',
					)
		);
		$expectedPTBR = array(
					'jsmessages' => array(
						'foo' => 'foo (EN)',
						'bar' => 'bar (EN)',
					),
					'messages' => array(
						'foo' => 'foo messages (PT)',
					),
					'validators' => array(
						'int' => 'integer (BR)',
						'str' => 'integer (PT)',
					)
		);
		$expectedResult = array ($expectedEN, $expectedEN, $expectedPT, $expectedPTBR);

		$resources = array(
			'en' => array(
				'jsmessages' => array(
					'foo' => 'foo (EN)',
					'bar' => 'bar (EN)',
				),
				'messages' => array(
					'foo' => 'foo messages (EN)',
				),
				'validators' => array(
					'int' => 'integer (EN)',
				),
			),
			'pt-PT' => array(
				'messages' => array(
					'foo' => 'foo messages (PT)',
				),
				'validators' => array(
					'str' => 'integer (PT)',
				),
			),
			'pt_BR' => array(
				'validators' => array(
					'int' => 'integer (BR)',
				),
			),
		);
		$localeArray = array(null, 'en', 'pt-PT', 'pt_BR');

		// we are going to test each scenario at a time
		foreach($expectedResult as $index => $expected) {

			$locale = $localeArray[$index];

			if(null === $locale) {
				$this->setLocale('en');					// set default locale to 'en'
				$this->getLocale()->shouldReturn('en');
			} else {
				$this->setLocale($locale);
				$this->getLocale()->shouldReturn($locale);
			}

			$locales = array_keys($resources);							//$resources contains every locale (not null)
			$_locale = (null !== $locale) ? $locale : reset($locales);	//if locale is null, we select the first locale in $resources
			$locales = array_slice($locales, 0, array_search($_locale, $locales));

			$this->setFallbackLocales(array_reverse($locales));
			$this->addLoader('array', new ArrayLoader());
			foreach ($resources as $_locale => $domainMessages) {
				foreach ($domainMessages as $domain => $messages) {
					$this->addResource('array', $messages, $_locale, $domain);
				}
			}

			$this->getMessages($locale)->shouldReturn($expected);
		}
	}
}
