<?php

namespace Spec\EddieJaoude\Bundle\SymfonyTranslationTwigCollectionBundle\Twig;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Translation\LoggingTranslator;

class TranslationLengthExtensionSpec extends ObjectBehavior
{

    function let(LoggingTranslator $translator)
    {
        $this->beConstructedWith($translator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('EddieJaoude\Bundle\SymfonyTranslationTwigCollectionBundle\Twig\TranslationLengthExtension');
    }

    function it_has_name()
    {
        $this->getName()->shouldReturn('translation_collection');
    }

    function it_has_filters()
    {
        $this->getFilters()->shouldBeArray();
    }

    function it_get_the_translation_length_filter(LoggingTranslator $translator)
    {
        $translator
            ->getMessages()
            ->shouldBeCalled()
            ->willReturn(
                array(
                    'messages' => array('information 1', 'information 2', 'information 3')
                )
            );
        $this->beConstructedWith($translator);

        $this->translationLengthFilter('translate.me')->shouldReturn(3);
    }
}
