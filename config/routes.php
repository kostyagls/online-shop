<?php

return array(
    'product/([0-9]+)' => 'product/view/$1',
    
    'catalog/page-([0-9]+)' => 'catalog/index/$1',
    'catalog' => 'catalog/index',
    
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',
    
    'cart/add/([0-9]+)' => 'cart/add/$1',
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart/checkout' => 'cart/checkout',
    'cart/delete/([0-9]+)' => 'cart/delete/$1',
    'cart' => 'cart/index',
    
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    
    'cabinet/view/([0-9]+)' => 'cabinet/view/$1',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet/history' => 'cabinet/history',
    'cabinet' => 'cabinet/index',
    
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',
    
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',
    
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order' => 'adminOrder/index',
    
    'admin' => 'admin/index',
    
    'about' => 'site/about',
    'contact' => 'site/contact',
    '[a-z]+' => 'site/index',
    '' => 'site/index', 
);

