<script type="text/javascript">
$(function() {	

  function slugize(str) 
  {
    str = str.toLowerCase();
    str = str.replace(/á/g,"a");
    str = str.replace(/Á/g,"a");
    str = str.replace(/é/g,"e");
    str = str.replace(/É/g,"e");
    str = str.replace(/í/g,"i");
    str = str.replace(/Í/g,"i");
    str = str.replace(/ó/g,"o");
    str = str.replace(/Ó/g,"o");
    str = str.replace(/ö/g,"o");
    str = str.replace(/Ö/g,"o");
    str = str.replace(/ő/g,"o");
    str = str.replace(/Ő/g,"o");
    str = str.replace(/ú/g,"u");
    str = str.replace(/Ú/g,"u");
    str = str.replace(/ü/g,"u");
    str = str.replace(/Ü/g,"u");
    str = str.replace(/ű/g,"u");
    str = str.replace(/Ű/g,"u");
    str = str.replace(/[^A-Za-z0-9\-_]/g,"_");
    
    return str
  }
  
  $('#cms_title').bind('keyup', function(event){
    title_id = $(this).attr('id') ;
    slug_id = title_id.replace('title', 'slug') ;
    $('#'+slug_id).val(slugize($('#'+title_id).val()));
  })

  $('#cms_slug').bind('change', function(){
    slug_id = $(this).attr('id') ;
    title_id = slug_id.replace('slug', 'title') ;
    if ($('#'+slug_id).val() != slugize($('#'+title_id).val()))
    {
      $('#'+title_id).unbind('keyup');  
    }
  })


})  
</script>