<?php


namespace Service\Order;


class Checkout
{
    /**
     * @var IBilling
     */
    private $billing;

    /**
     * @var IDiscount
     */
    private $discount;

    /**
     * @var ICommunication
     */
    private $communication;

    /**
     * @var ISecurity
     */
    private $security;

    /**
     * @var Product[]
     */
    private $products;

    public function __construct(BasketBuilder $builder)
    {
        $this->product = $builder->getProduct();
        $this->discount = $builder->getDiscount();
        $this->billing = $builder->getBilling();
        $this->security = $builder->getSecurity();
        $this->communication = $builder->getCommunication();
    }

    public function checkoutProcess(): void
    {
        $totalPrice = 0;
        foreach ($this->products as $product) {
            $totalPrice += $product->getPrice();
        }

        $discount = $this->discount->getDiscount();
        $totalPrice = $totalPrice - $totalPrice / 100 * $discount;

        $this->billing->pay($totalPrice);

        $user = $this->security->getUser();
        $this->communication->process($user, 'checkout_template');
    }
}