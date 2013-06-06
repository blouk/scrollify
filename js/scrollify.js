(function($) {

var scrollify = window.scrollify  = {
  state: 'upload',
  formdata:{},
  init:function(){
    var self = this;

    // Form data
    if(window.FormData) {
      self.formdata= new FormData();
    }
    
    // events handler
    $('#scrollify_btn_upload').on('click' ,self, self.submit_upload );
    $('#scrollify_video_input').on('change',self, self.input_change_handler)
    $(document).on('change_state', self.change_state);  
  },

  input_change_handler:function(e){
    var self = e.data;
    self.formdata = new FormData();
    if(!!this.files[0].type.match(/video.*/)){
      self.formdata.append("scrollify_video",this.files[0]);
    }
  },

  change_state:function(){
  },

  submit_upload:function(e){
    var self = e.data;
    e.preventDefault();
    $.ajax({
        url: "scrollify/Scrollify.php",
        type: "POST",
        contentType: 'multipart/form-data',
        data: self.formdata,
        processData: false,
        contentType: false,
        dataType: "json",
        cache: false,
        success: function (data) {
         self.show_images(data);
        }
      });
  },
  
  show_images: function(data){
    // empty the result div
    $('#result_img').html('');
    $('#result_img').append('<h2>Results for token:'+data.token+'</h2>');
    $.each(data.files , function(index,value){
      $('#result_img').append('<div><img src="scrollify/upload/' + value +'"></div>');
    });
  }  


};

scrollify.init();


})(jQuery);
