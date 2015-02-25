<?php

namespace EddieJaoude\Bundle\SymfonyTranslationTwigCollectionBundle\Translator;

use Symfony\Component\Translation\TranslatorInterface;

use Symfony\Bundle\FrameworkBundle\Translation\Translator as SymfonyTranslator;

/**
 * In order to ensure compatibility with Symfony 2.3, this class overrides the symfony translator component 
 * by providing the getMessages() method to the translator service, furthermore requested in the Translationlength Twig extension
 *
 * Class TranslatorExtension
 * @package EddieJaoude\Bundle\SymfonyTranslationTwigCollectionBundle\Translator
 */
class TranslatorExtension extends SymfonyTranslator
{

	/** 
	* This method is mainly inspired by Grygir
	* For further information, see Translator component in symfony 2.6  
	* https://github.com/symfony/symfony/blob/ef5d7c596e1dea02069edfd355d8e4b65d0d326c/src/Symfony/Component/Translation/Translator.php
	* Collects all messages.
	*
	* Collects all messages for the given locale.
	*
	* @param string|null $locale Locale of translations, by default is current locale
	*
	* @return array[array] indexed by catalog.
	*/
	public function getMessages($locale = null)
	{
		if ( false === is_callable(array($this, 'parent::getMessages') ) {

			if (null === $locale) {
				$locale = $this->getLocale();
			}
			if (!isset($this->catalogues[$locale])) {
				$this->loadCatalogue($locale);
			}
			$catalogues = array();
			$catalogues[] = $catalogue = $this->catalogues[$locale];
			while ($catalogue = $catalogue->getFallbackCatalogue()) {
				$catalogues[] = $catalogue;
			}
			$messages = array();
			for ($i = count($catalogues) - 1; $i >= 0; $i--) {
				$localeMessages = $catalogues[$i]->all();
				$messages = array_replace_recursive($messages, $localeMessages);
			}
		}
		else {
			$messages = parent::getMessages();
		}
		return $messages;
	}
}