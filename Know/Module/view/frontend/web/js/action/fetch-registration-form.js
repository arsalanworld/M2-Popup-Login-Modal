define([
    'mage/url',
    'jquery',
    'mage/storage'
], function (mageUrl, $, storageApi) {
    'use strict';

    return function () {
        let serviceUrl = mageUrl.build('module/index/index');

        return storageApi.get(serviceUrl, false);
    }
});
