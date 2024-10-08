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

namespace Sylius\Component\Attribute\Model;

use Sylius\Resource\Model\ResourceInterface;
use Sylius\Resource\Model\TranslationInterface;

interface AttributeTranslationInterface extends ResourceInterface, TranslationInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;
}
