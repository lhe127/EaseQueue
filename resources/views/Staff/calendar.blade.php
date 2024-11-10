@extends('Staff/dashboard')
@section('content')
<div class="w-[74rem] bg-white pt-10">
<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>

<body>
<div class="container">
    <div id='calendar'></div>
</div>

<!-- Modal for Adding Event -->
<div class="modal fade mt-[5rem]" id="eventModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="eventTitle" class="form-control" placeholder="Event Title">
        <input type="hidden" id="eventStart">
        <input type="hidden" id="eventEnd">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveEvent">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Deleting Event -->
<div class="modal fade mt-[5rem]" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this event?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
    var SITEURL = "{{ url('/') }}";
    var eventToDelete = null;

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: SITEURL + "/fullcalender",
        displayEventTime: false,
        selectable: true,
        selectHelper: true,

        select: function (start, end) {
            $('#eventStart').val(start.format("Y-MM-DD"));
            $('#eventEnd').val(end.format("Y-MM-DD"));
            $('#eventModal').modal('show');
        },

        eventDrop: function (event) {
            var start = event.start.format("Y-MM-DD");
            var end = event.end ? event.end.format("Y-MM-DD") : start;

            $.ajax({
                url: SITEURL + '/fullcalenderAjax',
                type: "POST",
                data: {
                    id: event.id,
                    title: event.title,
                    start: start,
                    end: end,
                    type: 'update'
                },
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        },

        eventClick: function (event) {
            eventToDelete = event;
            $('#deleteModal').modal('show');
        }
    });

    // Clear the input field when the modal is shown
    $('#eventModal').on('show.bs.modal', function () {
        $('#eventTitle').val(''); // Clear the input field
    });

    // Save new event
    $('#saveEvent').click(function() {
        var title = $('#eventTitle').val();
        var start = $('#eventStart').val();
        var end = $('#eventEnd').val();

        if (title) {
            $.ajax({
                url: SITEURL + "/fullcalenderAjax",
                type: "POST",
                data: { title: title, start: start, end: end, type: 'add' },
                success: function (data) {
                    if (data.success) {
                        calendar.fullCalendar('renderEvent', {
                            id: data.event.id,
                            title: title,
                            start: start,
                            end: end,
                            allDay: true
                        }, true);
                        $('#eventModal').modal('hide');
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        } else {
            toastr.error("Event title is required");
        }
    });

    // Confirm delete
    $('#confirmDelete').click(function() {
        if (eventToDelete) {
            $.ajax({
                url: SITEURL + '/fullcalenderAjax',
                type: "POST",
                data: { id: eventToDelete.id, type: 'delete' },
                success: function (response) {
                    if (response.success) {
                        calendar.fullCalendar('removeEvents', eventToDelete.id);
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                    $('#deleteModal').modal('hide');
                }
            });
        }
    });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
</div>
@endsection
