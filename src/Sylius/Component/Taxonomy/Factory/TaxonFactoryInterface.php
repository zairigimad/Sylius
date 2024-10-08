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

namespace Sylius\Component\Taxonomy\Factory;

use Sylius\Component\Taxonomy\Model\TaxonInterface;
use Sylius\Resource\Factory\FactoryInterface;

/**
 * @template T of TaxonInterface
 *
 * @extends FactoryInterface<T>
 */
interface TaxonFactoryInterface extends FactoryInterface
{
    public function createForParent(TaxonInterface $parent): TaxonInterface;
}
