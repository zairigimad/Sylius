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

namespace Sylius\Bundle\CoreBundle\Fixture;

use Doctrine\Persistence\ObjectManager;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Component\Currency\Model\CurrencyInterface;
use Sylius\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class CurrencyFixture extends AbstractFixture
{
    /** @param FactoryInterface<CurrencyInterface> $currencyFactory */
    public function __construct(private FactoryInterface $currencyFactory, private ObjectManager $currencyManager)
    {
    }

    public function load(array $options): void
    {
        foreach ($options['currencies'] as $currencyCode) {
            /** @var CurrencyInterface $currency */
            $currency = $this->currencyFactory->createNew();

            $currency->setCode($currencyCode);

            $this->currencyManager->persist($currency);
        }

        $this->currencyManager->flush();
    }

    public function getName(): string
    {
        return 'currency';
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
                ->arrayNode('currencies')
                    ->scalarPrototype()
        ;
    }
}
