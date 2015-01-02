<!-- Delete Event Popup -->
<div id="myModal-item-delete" class="modal cal_light_box hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Really ?</h3>
  </div>
  <div class="modal-body">
    <div class="confirm-delete">Confirm delete the event?</div>
    <div class="confirm-button">
      <form method="post" action="calendar/event/delete">  <input type="hidden" name="deleteEventId" id="deleteEventId" value=  > <button class="submit">Yes please.</a></button></form>
      <button class="submit dontdelete" id="dontdelete" >No Thanks.</a></button></div>
    </div>
  </div>
  <!-- End Delete Event Popup-->
