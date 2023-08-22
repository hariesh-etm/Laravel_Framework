var Common = Common || {};
Common.util = Common.util||(function(){
	_getPaginationLimit = function() {
		return 10;
	},
	_convertDate = function(cdate) {
		var formatter = '';
    if (!cdate) {
      return "";
    }
    cdate=cdate.replace("T"," ");
    var creationDate = new Date(cdate);
    var monthNames = [
      "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
      "Aug", "Sep", "Oct",
      "Nov", "Dec"
    ];
    var d = creationDate.getDate();
    if(_convertTime(cdate))
      formatter = creationDate.getDate() + '/' + (creationDate.getMonth() + 1) + '/' + creationDate.getFullYear().toString().substr(-2) + ', '+_convertTime(cdate);
    else
      formatter = monthNames[creationDate.getMonth()] + ' ' + d + self.nthFormat(d) + ' ' + creationDate.getFullYear().toString().substr(-2);

    return formatter;
	},
	_convertTime = function(cdate){
		var formatter = false;
    var t = cdate.split(/[- :]/);
    if(t.length>3){
      var formatter_date = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
      var hours = formatter_date.getHours();
      var minutes = formatter_date.getMinutes();
      var seconds = formatter_date.getSeconds();
      var ampm = hours >= 12 ? 'pm' : 'am';
      hours = hours % 12;
      hours = hours ? hours : 12;
      minutes = minutes < 10 ? '0' + minutes : minutes;
      seconds = seconds < 10 ? '0' + seconds : seconds;
      formatter = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    }
    return formatter;
	},
	_enumToString = function(string){
		if (string) {
      var string = string.toLowerCase();
      return _camelCase(string.replace(/_/g, " "));
    } else {
      return '';
    }
	},
	_camelCase = function(string){
		if (string) {
      var string = string.toLowerCase();
      return string.replace(/(?:^\w|[A-Z]|\b\w)/g, function(letter, index) {
        return letter.toUpperCase();
      }).replace(/\s+/g, ' ');
    } else {
      return '';
    }
	},
	_apiDelete = function(url, request_data, successCallBack, errorCallBack) {
		jQuery.ajax({
      dataType: 'json',
      type:'DELETE',
      contentType:"application/json",
			headers: { 'Auth': localStorage.getItem('auth_token'), 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') },
      data:JSON.stringify(request_data),
      url: url,
      success: function(response){
        if(successCallBack){
          successCallBack(response);
        }
      },
      error:function(xhr,status,err){
        if(errorCallBack){
          errorCallBack(xhr);
        }
      }
    });
	},
	_apiGet = function(url, request_data, successCallBack, errorCallBack) {
		jQuery.ajax({
      dataType: 'json',
      type:'GET',
      contentType:"application/json",
			headers: { 'Auth': localStorage.getItem('auth_token') },
      data:request_data,
      url: url,
      success: function(response){
				if(_apiErrorHandler(response)) {
					if(successCallBack){
						successCallBack(response);
					}
				}
      },
      error:function(xhr,status,err){
        if(errorCallBack){
            errorCallBack(xhr);
        }
				/*if (xhr.status == '401'){
					window.location.href=base_url+'access-denied'
				}
				if (xhr.status == '404'){
					window.location.href=base_url+'not-found'
				}*/
      }
    });
	},
	_logout = function(){
		var loadurl = base_url+"/api/v1/user/logout";
		var req_data = {};
		_apiGet(loadurl, req_data, function(response) {
			if(response.status=='SUCCESS'){
				localStorage.clear();
				window.location.href=base_url;
			}
		});
	},
	_apiErrorHandler = function(response){
		if(response) {
			if(response.status=='FAILED') {
				return false;
			}else{
				return true;
			}
		}
		return true;
	}
	return {
	  getPaginationLimit : 	_getPaginationLimit,
	  convertDate 		: 	_convertDate,
	  convertTime 		: 	_convertTime,
	  enumToString 		: 	_enumToString,
	  camelCase 	 		: 	_camelCase,
	  apiGet 					: 	_apiGet,
	  apiDelete 			: 	_apiDelete,
	  logout 					: 	_logout,
	}
})();
$(document).ready(function(){
	const fileInput = document.getElementById('image')
	let myFiles = [];
	let isFilesReady = true
	if(fileInput){
		fileInput.addEventListener('change', async (event) => {
		  myFiles = [];
		  isFilesReady = false
		  const inputKey = fileInput.getAttribute('name')
		  var files = event.srcElement.files;
		  const filePromises = Object.entries(files).map(item => {
		    return new Promise((resolve, reject) => {
		      const [index, file] = item
		      const reader = new FileReader();
		      reader.readAsBinaryString(file);
		      reader.onload = function(event) {
		        myFiles.push(`data:${file.type};base64,${btoa(event.target.result)}`);
		        resolve()
		      };
		      reader.onerror = function() {
		        console.log("can't read the file");
		        reject()
		      };
		    })
		  })
		  Promise.all(filePromises)
		    .then(() => {
		    	console.log(myFiles);
		      console.log('ready base64')
		      isFilesReady = true
		    })
		    .catch((error) => {
		      console.log(error)
		      console.log('something wrong happened')
		    })
		});
	}
	
	function deserializeToObject (){
    var result = {};
    this.replace(
      new RegExp("([^?=&]+)(=([^&]*))?", "g"),
      function($0, $1, $2, $3) { result[$1] = $3; }
    )
    return result;
	}
	String.prototype.deserializeToObject = deserializeToObject;
	$.ajaxSetup({
    headers: {
    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
	});
	var inlineAlerts='<div class="alert alert-success alert-dismissible fade d-none" role="alert"> <span class="text"> </span><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
	var popupAlerts='<div id="alertPopup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="alertLabel" aria-hidden="true"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="myModalLabel">Alert</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> </div><div class="modal-body m-4"></div></div></div></div>';
	$('.ajaxForm').on('submit', function(e) {
		e.preventDefault();
		var $this=$(this);
		var action = $this.attr('action');
		var method = $this.attr('method');
		if($this.valid()){
			$this.ajaxSubmit({
	     	dataType: 'JSON',
	      type: method,
				headers: { 'Auth': localStorage.getItem('auth_token') },
	      url: action,
	      /*data: function(data){
        	data.push({name: 'media', value: JSON.stringify(myFiles), type: 'text', required: true});
		    },*/
	      beforeSubmit: function(arr, $form, options) {
	      	$this.find('button[type=submit]').attr('data-hash',$this.find('button[type=submit]').text());
	      	$this.find('button[type=submit]').prop("disabled", true);
	      	$this.find('button[type=submit]').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
	      },
	      success: function(response){
	      	if(response.status=='SUCCESS'){
	      		if(typeof response.auth_token!='undefined' && response.auth_token){
	      			localStorage.setItem('auth_token', response.auth_token);
	      		}
	      		if(response.redirect){
	      			window.location.href=base_url;
	      			return;
	      		}
	      	}
	      	var errorMessageType=$this.attr('error.message');
	      	if(errorMessageType=='popup'){
	      		$("#alertPopup").remove();
	      		if($this.prepend(popupAlerts)){
	      			if(response.status=='FAILED'){
	      				$("#alertPopup .modal-body").removeClass('alert alert-success');
	      				$("#alertPopup .modal-body").addClass('alert alert-danger');
	      			}else{
	      				$("#alertPopup .modal-body").removeClass('alert alert-danger');
	      				$("#alertPopup .modal-body").addClass('alert alert-success');
	      			}
	      			$("#alertPopup .modal-body").text(response.message);
	      			$('#alertPopup').modal('show');
	      		}
	      	}else{
	      		$(".alert").remove();
	      		if($this.prepend(inlineAlerts)){
	      			if(response.status=='FAILED'){
	      				$this.find('.alert').removeClass('alert-success');
	      				$this.find('.alert').addClass('alert-danger');
	      			}else{
	      				$this.find('.alert').addClass('alert-success');
	      				$this.find('.alert').removeClass('alert-danger');
	      			}
	      			if($this.find('.alert .text').text(response.message)){
	      				$this.find('.alert').removeClass('d-none');
	      				$this.find('.alert').addClass('show');
	      			}
	      		}
	      	}
	      	$this.find('button[type=submit]').prop("disabled", false);
	      	$this.find('button[type=submit] .spinner-border').remove();
	      	$this.find('button[type=submit]').html($this.find('button[type=submit]').attr('data-hash'));
	      },
	      error:function(xhr,status,err){
	      	$this.find('button[type=submit]').prop("disabled", false);
	      	$this.find('button[type=submit] .spinner-border').remove();
	      	$this.find('button[type=submit]').html($this.find('button[type=submit]').attr('data-hash'));
	        /*if (xhr.status == '401'){
						window.location.href=base_url+'access-denied'
					}
					if (xhr.status == '404'){
						window.location.href=base_url+'not-found'
					}*/
	      }
	    })
		}
    
	  return false;
	});
	
	$('body .page-content #confirmationModal').on('click', '.save', function (event) {
    var $this=$(this);
    var id=$this.attr('data-id');
    var url=$this.attr('data-url');
    if(id && url){
	    Common.util.apiDelete(url, {id: id}, function(response){
	      if(response.status=="SUCCESS"){
	        $('#confirmationModal').modal('hide');
	      }
	    });	
    }
  });
});