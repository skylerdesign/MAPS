	<!-- Events Modal -->
	<div class="modal fade" id="events-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Appointments</h3>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn">Close</a>
            </div>
        </div>
    </div>
</div>
	
	<!-- Morris Charts JavaScript -->
    <script src="/bower_components/raphael/raphael-min.js"></script>
    <script src="/bower_components/morrisjs/morris.min.js"></script>
    <script src="/js/morris-data.js"></script>
    
    <!-- Calendar -->
    <script src="/bower_components/underscore/underscore-min.js"></script>
    <script type="text/javascript" src="/js/calendar.js"></script>
    <script type="text/javascript">
        var calendar = $("#calendar").calendar(
            {
                tmpl_path: "/tmpls/",
                modal: "#events-modal",
                modal_type : "template",
                modal_title: function(event) { return 'asdfasdf' },
                view: 'month',
                events_source: '/appointments/events.php',
                onAfterEventsLoad: function(events) {
					if(!events) {
						return;
					}
					var list = $('#eventlist');
					list.html('');
		
					$.each(events, function(key, val) {
						$(document.createElement('li'))
							.html('<a href="' + val.url + '">' + val.title + '</a>')
							.appendTo(list);
					});
				},
				onAfterViewLoad: function(view) {
					$('.page-header h3').text(this.getTitle());
					$('.btn-group button').removeClass('active');
					$('button[data-calendar-view="' + view + '"]').addClass('active');
				},
				classes: {
					months: {
						general: 'label'
					}
				}  
            });     
            
             
             
         $('.btn-group button[data-calendar-nav]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendar.navigate($this.data('calendar-nav'));
				});
			});
		
			$('.btn-group button[data-calendar-view]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendar.view($this.data('calendar-view'));
				});
			});
		
			$('#first_day').change(function(){
				var value = $(this).val();
				value = value.length ? parseInt(value) : null;
				calendar.setOptions({first_day: value});
				calendar.view();
			});
    </script>	
	

</body>

</html>