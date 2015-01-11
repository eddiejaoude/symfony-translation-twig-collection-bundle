<?php

namespace EddieJaoude\Bundle\SymfonyTranslationTwigCollectionBundle\Twig;

use Symfony\Component\Translation\LoggingTranslator;

/**
 * Class TranslationLengthExtension
 * @package EddieJaoude\Bundle\SymfonyTranslationTwigCollectionBundle\Twig
 */
class TranslationLengthExtension extends \Twig_Extension
{

    /**
     * @var LoggingTranslator
     */
    private $translator;

    /**
     * @param LoggingTranslator $translator
     */
    public function __construct(LoggingTranslator $translator)
    {
        $this->translator = $translator;
    }

    public function getName()
    {
        return 'translation_collection';
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('translationLength', array($this, 'translationLengthFilter')),
        );
    }

    /**
     * @param string $id
     *
     * @return int
     */
    public function translationLengthFilter($id)
    { 
        $total = 0;
        foreach ($this->translator->getMessages()['messages'] as $position => $message) {
            if (substr($position, 0, strlen($id)) === $id) {
                $total++;
            }
        }

        return $total - 1;
    }
}
