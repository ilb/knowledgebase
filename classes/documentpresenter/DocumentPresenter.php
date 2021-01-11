<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace documentpresenter;

/**
 *
 * @author gudov
 */
interface DocumentPresenter {
    /**
     * Показывает документ по пути
     * @param string $path
     */
    public function present($path);
}
