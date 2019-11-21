 // punthawee.s Create by

 var url = window.location;
// for sidebar menu but not for treeview submenu
$('ul.sidebar-menu a').filter(function() {
	return this.href == url;
}).parent().siblings().removeClass('active').end().addClass('active');
// for treeview which is like a submenu
$('ul.treeview-menu a').filter(function() {
	return this.href == url;
}).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active menu-open').end().addClass('active menu-open');

$(document).ready(function() {
	$('#excle_files').bind('change', function() {
                        //this.files[0].size gets the size of your file.
                        // 10485760  Bytes = 10MB
                        // 20971520  Bytes = 20MB
                        // 31457280 Bytes = 30MB
                        // 8388608  Bytes = 8MB
                        var _total_size = 0;
                        var _type_file = true;
                        for (var i = 0; i < this.files.length; i++) {
                        	_total_size += this.files[i].size;
                        	if(this.files[i].type != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' && this.files[i].type != 'application/vnd.ms-excel'){
                        		_type_file = false;
                        	}
                        }

                        count_file = this.files.length;

                        if(_total_size > 10485760){
                        	$('#excle_files').val('');
                        	swal('Warning!','คุณสามารถอัพโหลดไฟล์ได้ครั้งละ 10MB เท่านั้น','warning');
                        	return false;
                        }else if(!_type_file){
                        	$('#excle_files').val('');
                        	swal('Warning!','มีไฟล์บางรายการไม่ถูกต้อง กรุณาตรวจสอบนามสกุลไฟล์','warning');
                        	return false;
                        }else if(count_file > 20){
                        	$('#excle_files').val('');
                        	swal('Warning!','อัพโหลดไฟล์ได้ครั้งละไม่เกิน 1 ไฟล์เท่านั้น','warning');
                        	return false;
                        }
                    });
});
