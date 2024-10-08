<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\Sylius\Component\Locale\Provider;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Locale\Provider\LocaleCollectionProviderInterface;
use Sylius\Component\Locale\Provider\LocaleProviderInterface;
use Sylius\Resource\Doctrine\Persistence\RepositoryInterface;

final class LocaleProviderSpec extends ObjectBehavior
{
    function let(RepositoryInterface $localeRepository): void
    {
        $this->beConstructedWith($localeRepository, 'pl_PL');
    }

    function it_is_a_locale_provider_interface(): void
    {
        $this->shouldImplement(LocaleProviderInterface::class);
    }

    function it_returns_all_enabled_locales(RepositoryInterface $localeRepository, LocaleInterface $locale): void
    {
        $localeRepository->findAll()->willReturn([$locale]);
        $locale->getCode()->willReturn('en_US');

        $this->getAvailableLocalesCodes()->shouldReturn(['en_US']);
    }

    function it_returns_the_default_locale(): void
    {
        $this->getDefaultLocaleCode()->shouldReturn('pl_PL');
    }

    function it_returns_all_enabled_locales_via_collection_provider(
        LocaleCollectionProviderInterface $localeCollectionProvider,
        LocaleInterface $locale,
    ): void {
        $this->beConstructedWith($localeCollectionProvider, 'pl_PL');
        $localeCollectionProvider->getAll()->willReturn([$locale]);
        $locale->getCode()->willReturn('en_US');

        $this->getAvailableLocalesCodes()->shouldReturn(['en_US']);
    }
}
