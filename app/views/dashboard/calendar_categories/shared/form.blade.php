<h3>
  <input type="text" placeholder="title" class="edit_user_input parsley-validated" name="title" value="{{ $form->title }}" data-required="true"  data-show-errors="true"/>
</h3>

<div class="change_email_inner">
  <div class="row-fluid">
    <div class="span6 edit_user_left">
      <fieldset>
        <div class="control-group">
          <textarea class="add-proj-form-t" name="description" placeholder="Description">{{ $form->description }}</textarea>
        </div>
      </fieldset>
    </div>
    <div class="span6 edit_user_right">
      <fieldset>
        <label  for="public_content" >Is content public?</label>
        <div class="control-group">
          <input id="public_content" name="public_content" value="0" type="hidden" />
          {{ Form::checkbox('public_content', '1', $form->public_content) }}
        </div>
      </fieldset>
    </div>
  </div>
</div>
