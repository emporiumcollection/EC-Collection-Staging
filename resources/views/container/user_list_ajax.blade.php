@if(!empty($users))
					<?php $i=0; ?>
					@foreach($users as $user)
					<tr id="user_32119" class="search-match status-match ">
						<td class="rowtitle active">
						{{$user->first_name.' '.$user->last_name}}
						</td>
						@if(!empty($foldername))
							@if($foldername->parent_id>0)
								<td id="inherit_{{$user->id}}">
									<label>
										<input type="radio" rel="{{$user->id}}" class="inherit no-border" value="1" name="user[{{$i}}][inherit]" <?php if(!empty($permissions[$user->id])){ if($permissions[$user->id]->inherit==1){ echo 'checked="checked"'; } elseif($permissions[$user->id]->no_permission==0 && $permissions[$user->id]->view==0 && $permissions[$user->id]->upload==0 && $permissions[$user->id]->download==0 && $permissions[$user->id]->delete==0 && $permissions[$user->id]->inherit==0 && (!empty($foldername) && $foldername->parent_id>0)){ echo 'checked="checked"'; } } else { echo 'checked="checked"';} ?> > Inherit	
									</label>
								</td>
							@endif
						@endif
						<td id="none_{{$user->id}}">
							<label>
								<input type="hidden" name="user[{{$i}}][id]" value="{{$user->id}}">
								<input type="hidden" name="user[{{$i}}][per_id]" value="<?php echo (!empty($permissions[$user->id]) && $permissions[$user->id]->id!='')?$permissions[$user->id]->id:''; ?>">
								<input type="radio" rel="{{$user->id}}" class="none no-border" value="1" name="user[{{$i}}][no_permission]" <?php if(!empty($permissions[$user->id])){ if($permissions[$user->id]->no_permission==1){ echo 'checked="checked"'; } elseif($permissions[$user->id]->no_permission==0 && $permissions[$user->id]->view==0 && $permissions[$user->id]->upload==0 && $permissions[$user->id]->download==0 && $permissions[$user->id]->delete==0 && $permissions[$user->id]->inherit==0 && (!empty($foldername) && $foldername->parent_id==0)){ echo 'checked="checked"'; } }else{ if(!empty($foldername) && $foldername->parent_id==0){ echo 'checked="checked"';} } ?> > None	
							</label>
						</td>
						<td id="permis_{{$user->id}}">
							<label>
								<input type="checkbox" class="list no-border row view" rel="{{$user->id}}" rel2="view" name="user[{{$i}}][view]" value="1" <?php echo (!empty($permissions[$user->id]) && $permissions[$user->id]->view==1 && $permissions[$user->id]->inherit==0)?'checked="checked"':''; ?> > View</label>
							<label>
								<input type="checkbox" class="read no-border row download" rel="{{$user->id}}" rel2="download" name="user[{{$i}}][down]" value="1" <?php echo (!empty($permissions[$user->id]) && $permissions[$user->id]->download==1 && $permissions[$user->id]->inherit==0)?'checked="checked"':''; ?> > Download</label>
							<label>
								<input type="checkbox" class="create no-border row upload" rel="{{$user->id}}" rel2="upload" name="user[{{$i}}][up]" value="1" <?php echo (!empty($permissions[$user->id]) && $permissions[$user->id]->upload==1 && $permissions[$user->id]->inherit==0)?'checked="checked"':''; ?> > Upload</label>
							<label>
								<input type="checkbox" class="delete no-border row" rel="{{$user->id}}" rel2="delete" name="user[{{$i}}][del]" value="1" <?php echo (!empty($permissions[$user->id]) && $permissions[$user->id]->delete==1 && $permissions[$user->id]->inherit==0)?'checked="checked"':''; ?> > Delete</label>
						</td>
					</tr>
					<?php $i++; ?>
					@endforeach
				@endif