<?php

namespace components;


use yii\base\Component;

class Cat extends Component
{
    public function shout()
    {
        echo 'miao';

        $this->trigger('miao');
    }
}