<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class=" container ">
			<!--begin::Notice-->

<!--end::Notice-->

<!--begin::Example-->
<!--begin::Row-->
<div class="row">
   	<div class="col-lg-3">
   		<!--begin::Card-->
		<div class="card card-custom card-stretch">
			<div class="card-header">
				<div class="card-title">
					<h3 class="card-label">
						Event Categories
					</h3>
				</div>
			</div>
			<div class="card-body">
                <div id="kt_calendar_external_events" class="fc-unthemed">
                    <div class="btn btn-block text-left font-weight-bold btn-light-primary fc-draggable-handle mb-5 cursor-move" data-color="fc-event-primary">Sports</div>
                    <div class="btn btn-block text-left font-weight-bold btn-light-success fc-draggable-handle mb-5 cursor-move" data-color="fc-event-primary">Seminar & Training</div>
                    <div class="btn btn-block text-left font-weight-bold btn-light-danger fc-draggable-handle mb-5 cursor-move" data-color="fc-event-success">Cultural</div>
                    <div class="btn btn-block text-left font-weight-bold btn-light-info fc-draggable-handle mb-5 cursor-move" data-color="fc-event-warning">Celebrations</div>
                    <div class="btn btn-block text-left font-weight-bold btn-light-warning fc-draggable-handle cursor-move" data-color="fc-event-danger">Academic</div>
                    <div class="btn btn-block text-left font-weight-bold btn-light-success fc-draggable-handle cursor-move" data-color="fc-event-success">Community Service</div>
                    <div class="separator separator-dashed my-10"></div>

                    <div>
                        <label class="checkbox checkbox-primary">
                            <input type="checkbox" id="kt_calendar_external_events_remove"/> Remove after drop
                            <span></span>
                        </label>
                    </div>
                </div>
			</div>
		</div>
		<!--end::Card-->
   	</div>
   	<div class="col-lg-9">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">
        				KLD Event Calendar
        			</h3>
                </div>
                <div class="card-toolbar">
                    <a href="#" class="btn btn-light-primary font-weight-bold">
                        <i class="ki ki-plus "></i> Add Event
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div id="kt_calendar"></div>
            </div>
        </div>
        <!--end::Card-->
	</div>
</div>
<!--end::Row-->
<!--begin::Code example-->
<div class="example example-compact my-5">
	<div class="example-tools justify-content-center">
		<span class="example-toggle" data-toggle="tooltip" title="View code"></span>
		<span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
	</div>
	<div class="example-code">
		<ul class="example-nav nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-2x">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#example_code_html" >HTML</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#example_code_js" >JS</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="example_code_html" role="tabpanel">
				<div class="example-highlight"><pre ><code class="language-html">
                &lt;div class=&quot;row&quot;&gt;
                	&lt;div class=&quot;col-lg-3&quot;&gt;
                		&lt;!--begin::Card--&gt;
                		&lt;div class=&quot;card card-custom card-stretch&quot;&gt;
                			&lt;div class=&quot;card-header&quot;&gt;
                				&lt;div class=&quot;card-title&quot;&gt;
                					&lt;h3 class=&quot;card-label&quot;&gt;
                						External Events
                					&lt;/h3&gt;
                				&lt;/div&gt;
                			&lt;/div&gt;
                			&lt;div class=&quot;card-body&quot;&gt;
                				&lt;div id=&quot;kt_calendar_external_events&quot; class=&quot;fc-unthemed&quot;&gt;
                					&lt;div class=&quot;fc-draggable-handle label font-weight-bolder label-lg label-primary label-inline mb-5 cursor-move&quot; data-color=&quot;fc-event-primary&quot;&gt;Meeting&lt;/div&gt;&lt;br/&gt;
                					&lt;div class=&quot;fc-draggable-handle label font-weight-bolder label-lg label-primary label-inline mb-5 cursor-move&quot; data-color=&quot;fc-event-primary&quot;&gt;Conference Call&lt;/div&gt;&lt;br/&gt;&lt;br/&gt;
                					&lt;div class=&quot;fc-draggable-handle label font-weight-bolder label-lg label-success label-inline mb-5 cursor-move&quot; data-color=&quot;fc-event-success&quot;&gt;Dinner&lt;/div&gt;&lt;br/&gt;
                					&lt;div class=&quot;fc-draggable-handle label font-weight-bolder label-lg label-warning label-inline mb-5 cursor-move&quot; data-color=&quot;fc-event-warning&quot;&gt;Product Launch&lt;/div&gt;&lt;br/&gt;
                					&lt;div class=&quot;fc-draggable-handle label font-weight-bolder label-lg label-danger label-inline cursor-move&quot; data-color=&quot;fc-event-danger&quot;&gt;Reporting&lt;/div&gt;&lt;br/&gt;
                                    &lt;div class=&quot;fc-draggable-handle label font-weight-bolder label-lg label-success label-inline mb-5 cursor-move&quot; data-color=&quot;fc-event-success&quot;&gt;Project Update&lt;/div&gt;&lt;br/&gt;
                					&lt;div class=&quot;fc-draggable-handle label font-weight-bolder label-lg label-info label-inline mb-5 cursor-move&quot; data-color=&quot;fc-event-info&quot;&gt;Staff Meeting&lt;/div&gt;&lt;br/&gt;
                					&lt;div class=&quot;fc-draggable-handle label font-weight-bolder label-lg label-dark label-inline cursor-move&quot; data-color=&quot;fc-event-dark&quot;&gt;Lunch&lt;/div&gt;&lt;br/&gt;

                                    &lt;div class=&quot;separator separator-dashed my-10&quot;&gt;&lt;/div&gt;
                					&lt;div&gt;
                						&lt;label class=&quot;checkbox checkbox-primary&quot;&gt;
                						&lt;input type=&quot;checkbox&quot; id=&quot;kt_calendar_external_events_remove&quot;&gt; Remove after drop
                						&lt;span&gt;&lt;/span&gt;
                						&lt;/label&gt;
                					&lt;/div&gt;
                				&lt;/div&gt;
                			&lt;/div&gt;
                		&lt;/div&gt;
                		&lt;!--end::Card--&gt;
                	&lt;/div&gt;
                	&lt;div class=&quot;col-lg-9&quot;&gt;
                		&lt;!--begin::Card--&gt;
                		&lt;div class=&quot;card card-custom card-stretch&quot;&gt;
                			&lt;div class=&quot;card-header&quot;&gt;
                				&lt;div class=&quot;card-title&quot;&gt;
                					&lt;h3 class=&quot;card-label&quot;&gt;
                						Basic Calendar
                					&lt;/h3&gt;
                				&lt;/div&gt;
                				&lt;div class=&quot;card-toolbar&quot;&gt;
                					&lt;a href=&quot;#&quot; class=&quot;btn btn-light-primary font-weight-bold&quot;&gt;
                					&lt;i class=&quot;ki ki-plus &quot;&gt;&lt;/i&gt; Add Event
                					&lt;/a&gt;
                				&lt;/div&gt;
                			&lt;/div&gt;
                			&lt;div class=&quot;card-body&quot;&gt;
                				&lt;div id=&quot;kt_calendar&quot;&gt;&lt;/div&gt;
                			&lt;/div&gt;
                		&lt;/div&gt;
                		&lt;!--end::Card--&gt;
                	&lt;/div&gt;
                &lt;/div&gt;
				</code></pre></div>			</div>
			<div class="tab-pane" id="example_code_js">
				<div class="example-highlight"><pre style="height:400px"><code class="language-js">
                var KTCalendarExternalEvents = function() {

                    var initExternalEvents = function() {
                        $('#kt_calendar_external_events .fc-draggable-handle').each(function() {
                            // store data so the calendar knows to render an event upon drop
                            $(this).data('event', {
                                title: $.trim($(this).text()), // use the element's text as the event title
                                stick: true, // maintain when user navigates (see docs on the renderEvent method)
                                classNames: [$(this).data('color')],
                                description: 'Lorem ipsum dolor eius mod tempor labore'
                            });
                        });
                    }

                    var initCalendar = function() {
                        var todayDate = moment().startOf('day');
                        var YM = todayDate.format('YYYY-MM');
                        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                        var TODAY = todayDate.format('YYYY-MM-DD');
                        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                        var calendarEl = document.getElementById('kt_calendar');
                        var containerEl = document.getElementById('kt_calendar_external_events');

                        var Draggable = FullCalendarInteraction.Draggable;

                        new Draggable(containerEl, {
                            itemSelector: '.fc-draggable-handle',
                            eventData: function(eventEl) {
                                return $(eventEl).data('event');
                            }
                        });

                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],

                            isRTL: KTUtil.isRTL(),
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },

                            height: 800,
                            contentHeight: 780,
                            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                            nowIndicator: true,
                            now: TODAY + 'T09:25:00', // just for demo

                            views: {
                                dayGridMonth: { buttonText: 'month' },
                                timeGridWeek: { buttonText: 'week' },
                                timeGridDay: { buttonText: 'day' }
                            },

                            defaultView: 'dayGridMonth',
                            defaultDate: TODAY,

                            droppable: true, // this allows things to be dropped onto the calendar
                            editable: true,
                            eventLimit: true, // allow &quot;more&quot; link when too many events
                            navLinks: true,
                            events: [
                                {
                                    title: 'All Day Event',
                                    start: YM + '-01',
                                    description: 'Toto lorem ipsum dolor sit incid idunt ut',
                                    className: &quot;fc-event-danger fc-event-solid-warnin&quot;
                                },
                                {
                                    title: 'Reporting',
                                    start: YM + '-14T13:30:00',
                                    description: 'Lorem ipsum dolor incid idunt ut labore',
                                    end: YM + '-14',
                                    className: &quot;fc-event-success&quot;
                                },
                                {
                                    title: 'Foundation Week',
                                    start: YM + '-02',
                                    description: 'Lorem ipsum dolor sit tempor incid',
                                    end: YM + '-03',
                                    className: &quot;fc-event-primary&quot;
                                },
                                {
                                    title: 'ICT Expo 2017 - Product Release',
                                    start: YM + '-03',
                                    description: 'Lorem ipsum dolor sit tempor inci',
                                    end: YM + '-05',
                                    className: &quot;fc-event-light fc-event-solid-primary&quot;
                                },
                                {
                                    title: 'Dinner',
                                    start: YM + '-12',
                                    description: 'Lorem ipsum dolor sit amet, conse ctetur',
                                    end: YM + '-10'
                                },
                                {
                                    id: 999,
                                    title: 'Repeating Event',
                                    start: YM + '-09T16:00:00',
                                    description: 'Lorem ipsum dolor sit ncididunt ut labore',
                                    className: &quot;fc-event-danger&quot;
                                },
                                {
                                    id: 1000,
                                    title: 'Repeating Event',
                                    description: 'Lorem ipsum dolor sit amet, labore',
                                    start: YM + '-16T16:00:00'
                                },
                                {
                                    title: 'Conference',
                                    start: YESTERDAY,
                                    end: TOMORROW,
                                    description: 'Lorem ipsum dolor eius mod tempor labore',
                                    className: &quot;fc-event-primary&quot;
                                },
                                {
                                    title: 'Meeting',
                                    start: TODAY + 'T10:30:00',
                                    end: TODAY + 'T12:30:00',
                                    description: 'Lorem ipsum dolor eiu idunt ut labore'
                                },
                                {
                                    title: 'Lunch',
                                    start: TODAY + 'T12:00:00',
                                    className: &quot;fc-event-info&quot;,
                                    description: 'Lorem ipsum dolor sit amet, ut labore'
                                },
                                {
                                    title: 'Meeting',
                                    start: TODAY + 'T14:30:00',
                                    className: &quot;fc-event-warning&quot;,
                                    description: 'Lorem ipsum conse ctetur adipi scing'
                                },
                                {
                                    title: 'Happy Hour',
                                    start: TODAY + 'T17:30:00',
                                    className: &quot;fc-event-info&quot;,
                                    description: 'Lorem ipsum dolor sit amet, conse ctetur'
                                },
                                {
                                    title: 'Dinner',
                                    start: TOMORROW + 'T05:00:00',
                                    className: &quot;fc-event-solid-danger fc-event-light&quot;,
                                    description: 'Lorem ipsum dolor sit ctetur adipi scing'
                                },
                                {
                                    title: 'Birthday Party',
                                    start: TOMORROW + 'T07:00:00',
                                    className: &quot;fc-event-primary&quot;,
                                    description: 'Lorem ipsum dolor sit amet, scing'
                                },
                                {
                                    title: 'Click for Google',
                                    url: 'http://google.com/',
                                    start: YM + '-28',
                                    className: &quot;fc-event-solid-info fc-event-ligh&quot;,
                                    description: 'Lorem ipsum dolor sit amet, labore'
                                }
                            ],

                            drop: function(arg) {
                                // is the &quot;remove after drop&quot; checkbox checked?
                                if ($('#kt_calendar_external_events_remove').is(':checked')) {
                                    // if so, remove the element from the &quot;Draggable Events&quot; list
                                    $(arg.draggedEl).remove();
                                }
                            },

                            eventRender: function(info) {
                                var element = $(info.el);

                                if (info.event.extendedProps &amp;&amp; info.event.extendedProps.description) {
                                    if (element.hasClass('fc-day-grid-event')) {
                                        element.data('content', info.event.extendedProps.description);
                                        element.data('placement', 'top');
                                        KTApp.initPopover(element);
                                    } else if (element.hasClass('fc-time-grid-event')) {
                                        element.find('.fc-title').append('&lt;div class=&quot;fc-description&quot;&gt;' + info.event.extendedProps.description + '&lt;/div&gt;');
                                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                        element.find('.fc-list-item-title').append('&lt;div class=&quot;fc-description&quot;&gt;' + info.event.extendedProps.description + '&lt;/div&gt;');
                                    }
                                }
                            }
                        });

                        calendar.render();
                    }

                    return {
                        //main function to initiate the module
                        init: function() {
                            initExternalEvents();
                            initCalendar();
                        }
                    };
                }();

                jQuery(document).ready(function() {
                    KTCalendarExternalEvents.init();
                });
				</code></pre></div>			</div>
		</div>
	</div>
</div>
<!--end::Code example-->
<!--end::Example-->
		</div>
		<!--end::Container-->
	</div>
<!--end::Entry-->