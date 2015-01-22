var LightBox = {
    _lightBox: null,
    _content: null,

    _width: "600px",
    _height: "600px",
    
    width: function(val) {
        if(val == "undefined") return this._width;
        this._width = val;
        return this;
    },

    height: function(val) {
        if(val == "undefined") return this._height;
        this._height = val;
        return this;
    },
    
    //initialize light box and hide it in page
    init: function() {
            
        if( this._lightBox == null) {
            this._lightBox = document.createElement('div');
            $(this._lightBox).attr('id', 'lightBox').hide();
         
            this._content = document.createElement('div');
            $(this._content).attr('class', 'content');
            $(this._content).appendTo(this._lightBox);
    
            var that = this;
            //add check for click outside box to close it
            $(this._lightBox).mouseup(function(e) {
                that.close(e);
            });

            $('body').append(this._lightBox);
            return this;
        }
    },
        
    close: function(e) {
        var box = $(this._lightBox).find('.content');
        if(!box.is(e.target) && box.has(e.target).length==0) {
            $(box).empty();
            $(this._lightBox).hide();
        }     
    },
    
    show: function(data) {
        if(this._content != null) { 
            $(this._content).html(data)
                .css('width', this._width).css('height', this._height);
            $(this._lightBox).show();
        }
    }   
};