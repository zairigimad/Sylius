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

namespace Sylius\Bundle\CoreBundle\Form\EventSubscriber;

use Sylius\Bundle\CurrencyBundle\Form\Type\CurrencyChoiceType;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Resource\Exception\UnexpectedTypeException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class AddBaseCurrencySubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
        ];
    }

    public function preSetData(FormEvent $event): void
    {
        $resource = $event->getData();
        $disabled = $this->getDisabledOption($resource);

        $form = $event->getForm();
        $form->add('baseCurrency', CurrencyChoiceType::class, [
            'label' => 'sylius.form.channel.currency_base',
            'required' => true,
            'disabled' => $disabled,
        ]);
    }

    /**
     * @throws UnexpectedTypeException
     */
    private function getDisabledOption($resource): bool
    {
        if ($resource instanceof ChannelInterface) {
            return null !== $resource->getId() && null !== $resource->getBaseCurrency();
        }

        if (null === $resource) {
            return false;
        }

        throw new UnexpectedTypeException($resource, ChannelInterface::class);
    }
}
