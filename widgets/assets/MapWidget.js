$.widget("execut.MapWidget", {
    _isInited: false,
    _create: function () {
        var t = this,
            el = t.element,
            callback = function () {
                t._initMap();
            };
        $(document).scroll(function() {
            if (t.isInViewport()) {
                callback();
            }
        });
        if (t.options.isInitAfterLoad) {
            callback();
        }
    },
    isInViewport: function() {
        var el = this.element;
        var elementTop = $(el).offset().top;
        var elementBottom = elementTop + $(el).outerHeight();

        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    },
    _initMap: function () {
        var myMap,
            t = this,
            el = t.element;

        if (t._isInited) {
            return;
        }

        t._isInited = true;
        // var scriptEl = $('<script type="text/javascript" src="https://api-maps.yandex.ru/2.1/?lang=ru_RU">');

        $.getScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU', function () {
            var markImg = '/images/geop.png';
            var markSize = [35, 53];
            var markOffset = [-3, -53];
            var openedBaloon = -1;

            function init() {
                el.find('img, .map-image').hide();
                var centerCoord = t.options.coords;
                myMap = new ymaps.Map(el.attr('id'), {
                    center: centerCoord,
                    zoom: 10
                });

                var shops = t.options.shops;
                openedBaloon = t.options.openedBaloon;
                var clusterer = new ymaps.Clusterer({
                    /**
                     * Через кластеризатор можно указать только стили кластеров,
                     * стили для меток нужно назначать каждой метке отдельно.
                     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/option.presetStorage.xml
                     */
                    preset: 'islands#yellowClusterIcons',
                    /**
                     * Ставим true, если хотим кластеризовать только точки с одинаковыми координатами.
                     */
                    groupByCoordinates: false,
                    /**
                     * Опции кластеров указываем в кластеризаторе с префиксом "cluster".
                     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ClusterPlacemark.xml
                     */
                    clusterDisableClickZoom: true,
                    clusterHideIconOnBalloonOpen: false,
                    geoObjectHideIconOnBalloonOpen: false,
                });
                // Открытие балуна кластера с выбранным объектом.

// Поскольку по умолчанию объекты добавляются асинхронно,
// обработку данных можно делать только после события, сигнализирующего об
// окончании добавления объектов на карту.
                clusterer.events.add('objectsaddtomap', function () {

                    // Получим данные о состоянии объекта внутри кластера.
                    var geoObjectState = cluster.getObjectState(myGeoObjects[1]);
                    // Проверяем, находится ли объект находится в видимой области карты.
                    if (geoObjectState.isShown) {

                        // Если объект попадает в кластер, открываем балун кластера с нужным выбранным объектом.
                        if (geoObjectState.isClustered) {
                            geoObjectState.cluster.state.set('activeObject', myGeoObjects[1]);
                            geoObjectState.cluster.balloon.open();

                        } else {
                            // Если объект не попал в кластер, открываем его собственный балун.
                            myGeoObjects[1].balloon.open();
                        }
                    }

                });

                var geoObjects = [];
                shops.forEach(function (item, i, arr) {
                    var coords = item.coords.split(',');
                    var coords_new = [];
                    coords_new[0] = parseFloat(coords[1]);
                    coords_new[1] = parseFloat(coords[0]);
                    var geoObject = new ymaps.Placemark(coords_new,
                        {
                            hintContent: item.hintContent,
                            balloonContentHeader: item.balloonContentHeader,
                            balloonContentBody: item.balloonContentBody
                        }, {
                            iconLayout: 'default#image',
                            iconImageHref: markImg,
                            iconImageSize: markSize,
                            iconImageOffset: markOffset
                        }
                    );

                    geoObjects[i] = geoObject;

                    clusterer.add(geoObject);
                });
                clusterer.options.set({
                    minClusterSize: 1,
                    gridSize: 80,
                    clusterDisableClickZoom: true,
                    iconLayout: 'default#image',
                    iconImageHref: markImg,
                    iconImageSize: markSize,
                    iconImageOffset: markOffset
                });

                myMap.geoObjects.add(clusterer);

                var scrollIsEnabled = false;
                el.bind('mouseout', function () {
                    if (scrollIsEnabled) {
                        myMap.behaviors.disable('scrollZoom');
                        scrollIsEnabled = false;
                    }
                });

                myMap.events.add('mousedown', function () {
                    if (!scrollIsEnabled) {
                        myMap.behaviors.enable('scrollZoom');
                        scrollIsEnabled = true;
                    }
                });

                myMap.behaviors.disable('scrollZoom');
                if (openedBaloon > 0) {
                    var geoObjectState = clusterer.getObjectState(geoObjects[openedBaloon]);
                    clusterer.balloon.open(geoObjectState.cluster);
                }
            }

            ymaps.ready(init);
        });
        // $.body().append(scriptEl);
    },
});