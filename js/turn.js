/*!
 * Turn.js v4
 * Copyright 2012, Emmanuel Garcia
 * MIT License
 */
(function($) {
    var options = {
        width: 800,
        height: 600,
        autoCenter: true,
        gradients: true,
        acceleration: true,
        elevation: 50,
        pages: 4,
        direction: "ltr",
        duration: 1000,
        when: {
            turning: function(e, page, view) {
                var book = $(this);
                if (page == 1) {
                    book.turn('center');
                }
            }
        }
    };

    $.fn.turn = function(opts) {
        return this.each(function() {
            var $this = $(this);
            var data = $this.data('turn');
            
            if (!data) {
                data = new Turn(this, $.extend({}, options, opts));
                $this.data('turn', data);
            }
        });
    };

    function Turn(element, options) {
        this.element = element;
        this.options = options;
        this.pages = [];
        this.currentPage = 1;
        this.totalPages = options.pages;
        this.direction = options.direction;
        this.duration = options.duration;
        
        this.init();
    }

    Turn.prototype = {
        init: function() {
            var self = this;
            var $element = $(this.element);
            
            // Crear contenedor de páginas
            $element.html('<div class="pages"></div>');
            
            // Agregar páginas
            for (var i = 1; i <= this.totalPages; i++) {
                $element.find('.pages').append(
                    $('<div class="page"></div>').html(
                        $('<img>').attr('src', 'img/carta_masneo_pages-to-jpg-' + 
                            String(i).padStart(4, '0') + '.jpg')
                    )
                );
            }
            
            // Inicializar estilos
            $element.css({
                'position': 'relative',
                'width': this.options.width,
                'height': this.options.height,
                'margin': '0 auto'
            });
            
            // Agregar eventos
            $element.on('click', '.page', function(e) {
                var $page = $(this);
                var pageNum = $page.index() + 1;
                
                if (e.pageX < $page.width() / 2 && pageNum > 1) {
                    self.prev();
                } else if (e.pageX >= $page.width() / 2 && pageNum < self.totalPages) {
                    self.next();
                }
            });
        },
        
        prev: function() {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.updatePages();
            }
        },
        
        next: function() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
                this.updatePages();
            }
        },
        
        updatePages: function() {
            var $pages = $(this.element).find('.pages');
            var offset = -(this.currentPage - 1) * this.options.width;
            
            $pages.css({
                'transform': 'translateX(' + offset + 'px)',
                'transition': 'transform ' + this.duration + 'ms'
            });
        }
    };
})(jQuery); 