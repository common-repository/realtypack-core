<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>

<div class="rtpc-agent-dashboard clearfix">
	<div class="rtpc-agent-dashboard-sidebar">
		<div class="rtpc-agent-dashboard-profile-info">
			<img src="<?php echo RTPC_ASSETS_URL . 'assets/admin/img/profile.png';?>"  height="110" width="auto"/>
			<span><?php echo esc_html_e( 'Welcome back, ', 'realty-pack-core'); echo 'Sarah Anderson'; ?></span>
		</div>	
		<ul class="rtpc-agent-dashboard-menu">
			<li class="active">
				<a href="#">
					<i class="rtpf-setting"></i>
					<?php echo esc_html_e( 'My Profile', 'realty-pack-core'); ?>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="rtpf-add"></i>
					<?php echo esc_html_e( 'Add New Property', 'realty-pack-core'); ?>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="rtpf-property"></i>
					<?php echo esc_html_e( 'My Properties List', 'realty-pack-core'); ?>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="rtpf-heart-2"></i>
					<?php echo esc_html_e( 'Favorites', 'realty-pack-core'); ?>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="rtpf-search-2"></i>
					<?php echo esc_html_e( 'Save Searches', 'realty-pack-core'); ?>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="rtpf-dollar"></i>
					<?php echo esc_html_e( 'My invoices', 'realty-pack-core'); ?>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="rtpf-message"></i>
					<?php echo esc_html_e( 'Messages', 'realty-pack-core'); ?>
				</a>
			</li>	
			<li>
				<a href="#">
					<i class="rtpf-logout"></i>
					<?php echo esc_html_e( 'Logout', 'realty-pack-core'); ?>
				</a>
			</li>	
		</ul>	
	</div>	
	<div class="rtpc-agant-dashboard-content">
		<div class="rtpc-agant-dashboard-content-inner">
			<h2 class="rtpc-agant-dashboard-header">
				Add New Property
			</h2>
			<div class="rtpc-agant-dashboard-form">
				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Basic Information</label>
						<span class="subtitle">Add your contact information</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-12 rtpc-agant-dashboard-form-element">
								<label>Property Title*</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-12 rtpc-agant-dashboard-form-element">
								<label>Description</label>
								<textarea></textarea>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Property type</label>
								<select>
									<option value="1">Appartment</option>
								</select>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Status</label>
								<select>
									<option value="1">For Sale</option>
								</select>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Label</label>
								<select>
									<option value="1">Feature</option>
								</select>
							</div>
					
						</div>
					</div>
				</div>
				<div class="separator"></div>
				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Property Price</label>
						<span class="subtitle">Add your property pricing information</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Price (in $ just number)*</label>
								<input type="text" placeholder="Ex: 4500000" />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>After Price Label </label>
								<input type="text"  placeholder="Ex: per month" />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Before Price Label</label>
								<input type="text" placeholder="Ex: from"  />
							</div>
						</div>	
					</div>	
				</div>
				<div class="separator"></div>
				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Property Image</label>
						<span class="subtitle">Add your property images</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="tfc-agant-dashboard-form-img-drag">
							Click to image or Drop file Here
						</div>	
						<div class="guide">
							* At least 1 image is required for a valid submission. Minimum size is 930/580px. ** Click on star on the image to select featured. *** Change images order with Drag & Drop.
						</div>	
						<ul>
							<li>
								<img src="">
							</li>
							<li>
								<img src="">
							</li>	
						</ul>	
					</div>	
				</div>	
				<div class="separator"></div>

				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Listing Location</label>
						<span class="subtitle">Select your listing location here</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-12 rtpc-agant-dashboard-form-element">
								<label>*Friendly Address</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>COUNTY / STATE</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>AREA</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>CITY</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>COUNTRY</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Neighborhood</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-12 google-map">
							</div>	
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Google Maps latitude</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Google Maps longitude</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Google Map Street View</label>
								<input type="text"  />
							</div>
						</div>	
					</div>	
				</div>	
				<div class="separator"></div>

				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Property Details</label>
						<span class="subtitle">Add you Property Details here</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Area Size</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Property ID</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Size Prefix</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Lot Size in ft2</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Rooms</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Bedrooms</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Garages</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Garages Size</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Roofing</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Basement</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Available from...</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-12">
								<div class="rtpc-agant-dashboard-form-additionl">
									<h2>Add Additional Features</h2>
									<div class="rtp-row">
										<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
											<label>Name</label>
											<input type="text"  />
										</div>
										<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
											<label>value</label>
											<input type="text"  />
										</div>
										<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
											<label>Add</label>
											<a href="#" class="rtpc-agant-dashboard-btn">Add</a>
										</div>
									</div>
									<div class="separator"></div>
									<div class="rtpc-agant-dashboard-form-additionl-item">
										<span class="label">Water : City</span> 
										<a class="btn">
											<i class="rtpf-delete"></i>
											REMOVE
										</a>
									</div>		

								</div>

							</div>	

						</div>	
					</div>	
				</div>	
				<div class="separator"></div>
				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Property Features</label>
						<span class="subtitle">Add your property features here</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<label>Air Conditioning</label>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<label>Barbeque</label>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<label>Lawn</label>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<label>Laundry</label>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<label>Microwave</label>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<label>Dryer</label>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<label>Outdoor</label>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<label>Gym</label>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<label>Sauna</label>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<label>Swimming Pool</label>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<label>Refrigerator</label>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<label>Washer</label>
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element checkbox">
								<input type="checkbox"  />
								<a href="">+ Add new Feature</a>
							</div>
						
						</div>	
					</div>	
				</div>

				<div class="separator"></div>

				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Listing Location</label>
						<span class="subtitle">Select your listing location here</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Plan Title</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Plan Bedrooms</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Plan Bathrooms</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Plan Price</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-4 rtpc-agant-dashboard-form-element">
								<label>Plan Size</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-12 rtpc-agant-dashboard-form-element">
								<label>Plan Image</label>
								<input type="text"  />
							</div>
						</div>	
					</div>	
				</div>	
				<div class="separator"></div>

				

				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Attachments</label>
						<span class="subtitle">Select your attachments here</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-12 rtpc-agant-dashboard-form-element">
								<label>PDF Attachments</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-12 rtpc-agant-dashboard-form-element">
								<label>DOC Attachments</label>
								<input type="text"  />
							</div>
						</div>	
					</div>	
				</div>	
				<div class="separator"></div>
				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Virtual Tour & Video Option</label>
						<span class="subtitle">Add your Virtual Tour here</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Virtual Video (Embeded Code)</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Youtube Video Link</label>
								<input type="text"  />
							</div>
						</div>	
					</div>	
				</div>	
				<div class="separator"></div>

				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Energy class</label>
						<span class="subtitle">Add your Energy class here</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Energy Class</label>
								<select>
									<option>Select Energy class</option>
									<option>A</option>
									<option>B</option>
									<option>C</option>
								</select>	
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Global energy performance index</label>
								<input type="text"  placeholder="Eg: 92.42 kWh / m²a" />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Renewable energy performance index</label>
								<input type="text"  placeholder="Eg: 92.42 kWh / m²a" />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Global energy performance index</label>
								<input type="text"  placeholder="Eg: 92.42 kWh / m²a" />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Energy performance of the building</label>
								<input type="text"  placeholder="Eg: 92.42 kWh / m²a" />
							</div>

						</div>	
					</div>	
				</div>	
				<div class="separator"></div>

				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Private Note</label>
						<span class="subtitle">Add your Private Note</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-12 rtpc-agant-dashboard-form-element">
								<label>Note</label>
								<textarea></textarea>
							</div>
							
						</div>	
					</div>	
				</div>	
				<div class="separator"></div>

				<div class=" rtpc-agant-dashboard-form-btns">
					<a href="#" class="rtpc-agant-dashboard-btn purple">UPDATE PASSWORD</a>
					<a href="#" class="rtpc-agant-dashboard-btn blue">RESET PASSWORD</a>
				</div>	


			</div>

			<h2 class="rtpc-agant-dashboard-header">
				My Listing Properties
			</h2>
			<div class="rtpc-agant-dashboard-listing-manager">
                <div class="rtp-row">
                	<div class="rtp-col-md-9">
                		<div class="rtpc-agant-dashboard-search">
		                	<input type="text" placeholder="Search a listing..." />
		                	<a href=""  class="rtpc-agant-dashboard-search-btn">
		                		<span>Search</span>
		                		<i class="rtpf-search"></i>
		                	</a>
	                	</div>	
                	</div>
                	<div class="rtp-col-md-3">
                		<div class="rtpc-agant-dashboard-search rtpc-agant-dashboard-filter">
                			<select>
                				<option>SORT BY: Default</option>
                				<option>Price</option>
                				<option>location</option>
                			</select>
                		</div>	
                	</div>	
	               
            	</div>
				<div class="rtpc-agent-dashboard-property">
					<img class="property-image" src="<?php echo RTPC_ASSETS_URL . 'assets/admin/img/profile.png';?>"  height="210" width="auto"/>
					<div class="rtpc-agent-dashboard-property-info">
						<h3 class="property-title">
							Bedroom Duplex Apartment
							<span class="rtpc-agent-dashboard-property-tag orange">Pending Approval</span>
						</h3>
						<div class="property-location">
							<i class="rtpc-rpgs-property-address-text"></i>
							231 Fenimore St, Brooklyn, NY 11225, USA
						</div>
						<div class="property-fields clearfix">
							<ul class="fields clearfix">
								<li>
									<label>Expires on:</label>
									<span class="rtpc-blue-text-color">2019-02-14</span>
								</li>
								<li>
									<label>Type:</label>
									<span class="rtpc-blue-text-color">Apartment</span>
								</li>
								<li>
									<label>Status:</label>
									<span class="rtpc-blue-text-color">Sale</span>
								</li>
							</ul>
						
							<ul class="actions clearfix">
								<li>
									<a href="" class="rtpc-agent-dashboard-tiny-btn">
										<i class="rtpf-delete"></i>
									</a>	
								</li>	
								<li>
									<a href="" class="rtpc-agent-dashboard-tiny-btn">
										<i class="rtpf-edit"></i>
									</a>	
								</li>	
								<li>
									<a href="" class="rtpc-agent-dashboard-tiny-btn">
										<i class="rtpf-clone"></i>
									</a>	
								</li>	
							</ul>	
						</div>	
						<div class="property-price">$6,302,000</div>	
					</div>
				</div>
				<div class="rtpc-agent-dashboard-property">
					<img class="property-image" src="<?php echo RTPC_ASSETS_URL . 'assets/admin/img/profile.png';?>"  height="210" width="auto"/>
					<div class="rtpc-agent-dashboard-property-info">
						<h3 class="property-title">
							Bedroom Duplex Apartment
							<span class="rtpc-agent-dashboard-property-tag pink">Pending payment</span>
						</h3>
						<div class="property-location">
							<i class="rtpc-rpgs-property-address-text"></i>
							231 Fenimore St, Brooklyn, NY 11225, USA
						</div>
						<div class="property-fields clearfix">
							<ul class="fields clearfix">
								<li>
									<label>Expires on:</label>
									<span class="rtpc-blue-text-color">2019-02-14</span>
								</li>
								<li>
									<label>Type:</label>
									<span class="rtpc-blue-text-color">Apartment</span>
								</li>
								<li>
									<label>Status:</label>
									<span class="rtpc-blue-text-color">Sale</span>
								</li>
							</ul>
						
							<ul class="actions clearfix">
								<li>
									<a href="" class="rtpc-agent-dashboard-tiny-btn">
										<i class="rtpf-delete"></i>
									</a>	
								</li>	
								<li>
									<a href="" class="rtpc-agent-dashboard-tiny-btn">
										<i class="rtpf-edit"></i>
									</a>	
								</li>	
								<li>
									<a href="" class="rtpc-agent-dashboard-tiny-btn">
										<i class="rtpf-clone"></i>
									</a>	
								</li>	
							</ul>	
						</div>	
						<div class="property-price">$6,302,000</div>	
					</div>
				</div>	<div class="rtpc-agent-dashboard-property">
					<img class="property-image" src="<?php echo RTPC_ASSETS_URL . 'assets/admin/img/profile.png';?>"  height="210" width="auto"/>
					<div class="rtpc-agent-dashboard-property-info">
						<h3 class="property-title">
							Bedroom Duplex Apartment
							<span class="rtpc-agent-dashboard-property-tag green">Approved</span>
						</h3>
						<div class="property-location">
							<i class="rtpc-rpgs-property-address-text"></i>
							231 Fenimore St, Brooklyn, NY 11225, USA
						</div>
						<div class="property-fields clearfix">
							<ul class="fields clearfix">
								<li>
									<label>Expires on:</label>
									<span class="rtpc-blue-text-color">2019-02-14</span>
								</li>
								<li>
									<label>Type:</label>
									<span class="rtpc-blue-text-color">Apartment</span>
								</li>
								<li>
									<label>Status:</label>
									<span class="rtpc-blue-text-color">Sale</span>
								</li>
							</ul>
						
							<ul class="actions clearfix">
								<li>
									<a href="" class="rtpc-agent-dashboard-tiny-btn">
										<i class="rtpf-delete"></i>
									</a>	
								</li>	
								<li>
									<a href="" class="rtpc-agent-dashboard-tiny-btn">
										<i class="rtpf-edit"></i>
									</a>	
								</li>	
								<li>
									<a href="" class="rtpc-agent-dashboard-tiny-btn">
										<i class="rtpf-clone"></i>
									</a>	
								</li>	
							</ul>	
						</div>	
						<div class="property-price">$6,302,000</div>	
					</div>
				</div>
			</div>	


			<h2 class="rtpc-agant-dashboard-header">
				Favorite Properties
			</h2>
			<div class="rtpc-agant-dashboard-favorites">
				<div class="rtp-row">
					<div class="rtp-col-md-9">
						<div class="rtpc-agent-dashboard-property">
							<img class="property-image" src="<?php echo RTPC_ASSETS_URL . 'assets/admin/img/profile.png';?>"  height="210" width="auto"/>
							<div class="rtpc-agent-dashboard-property-info">
								<h3 class="property-title">Bedroom Duplex Apartment</h3>
								<div class="property-location">
									<i class="rtpc-rpgs-property-address-text"></i>
									231 Fenimore St, Brooklyn, NY 11225, USA
								</div>
								<div class="property-fields clearfix">
									<ul class="fields clearfix">
										<li>
											<label>Bed:</label>
											<span class="rtpc-blue-text-color">3</span>
										</li>
										<li>
											<label>Bath:</label>
											<span class="rtpc-blue-text-color">1</span>
										</li>
										<li>
											<label>Sqft:</label>
											<span class="rtpc-blue-text-color">1430</span>
										</li>
									</ul>
								</div>	
								<div class="property-price">$6,302,000</div>	
							</div>
						</div>
					</div>
					<div class="rtp-col-md-3 rtpc-agant-dashboard-align-right">
						<a href="" class="rtpc-agant-dashboard-btn red">Remove</a>
					</div>	
				</div>
				<div class="separator"></div>
				<div class="rtp-row">
					<div class="rtp-col-md-9">
						<div class="rtpc-agent-dashboard-property">
							<img class="property-image" src="<?php echo RTPC_ASSETS_URL . 'assets/admin/img/profile.png';?>"  height="210" width="auto"/>
							<div class="rtpc-agent-dashboard-property-info">
								<h3 class="property-title">Bedroom Duplex Apartment</h3>
								<div class="property-location">
									<i class="rtpf-location"></i>
									231 Fenimore St, Brooklyn, NY 11225, USA
								</div>
								<div class="property-fields clearfix">
									<ul class="fields clearfix">
										<li>
											<label>Bed:</label>
											<span class="rtpc-blue-text-color">3</span>
										</li>
										<li>
											<label>Bath:</label>
											<span class="rtpc-blue-text-color">1</span>
										</li>
										<li>
											<label>Sqft:</label>
											<span class="rtpc-blue-text-color">1430</span>
										</li>
									</ul>
								</div>	
								<div class="property-price">$6,302,000</div>	
							</div>
						</div>
					</div>
					<div class="rtp-col-md-3 rtpc-agant-dashboard-align-right">
						<a href="" class="rtpc-agant-dashboard-btn red">Remove</a>
					</div>	
				</div>
				<div class="separator"></div>
				
			</div>


			<div class="rtpc-agant-dashboard-statistics">
				<h3 class="title">Your current package: <span class="rtpc-red-text-color">Free membership</span></h3>
				<div class="separator"></div>
				<div class="rtp-row">
					<div class="rtp-col-md-3">
						<div class="item">
							<div>
								<span>Listing included: </span>
								<span>10</span>
							</div>
							<div class="circle">
								<span class="number rtpc-red-text-color">7</span>
								<span>listings</span>
							</div>
							<div>Featured Remaining</div>
						</div>	
					</div>	
					<div class="rtp-col-md-3">
						<div class="item">
							<div>
								<span>Featured included: </span>
								<span>10</span>
							</div>
							<div class="circle">
								<span class="number rtpc-orange-text-color">2</span>
								<span>listings</span>
							</div>
							<div>listing Remaining</div>
						</div>	
					</div>	
					<div class="rtp-col-md-3">
						<div class="item">
							<div>
								<span>Image included: </span>
								<span>10</span>
							</div>
							<div class="circle">
								<span class="number rtpc-blue-text-color">3</span>
								<span>Images</span>
							</div>
							<div>Image Remaining</div>
						</div>	
					</div>	
					<div class="rtp-col-md-3">
						<div class="item">
							<div>
								<span>End on: </span>
								<span>2019-02-09</span>
							</div>
							<div class="circle">
								<span class="number rtpc-green-text-color">153</span>
								<span>Days</span>
							</div>
							<div>Duration Remaining</div>
						</div>	
					</div>	
				</div>
				<div class="separator"></div>
				<div class="">
					<span>
						See Available Packages and Payment Methods
						<i class="rtpf-arrow-down"></i>
					</span>
				</div>	
			</div>	

			<div class="rtpc-agant-dashboard-form">
				<h2 class="rtpc-agant-dashboard-header">
					My Profile
				</h2>	
				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Photo</label>
						<span class="subtitle">Upload a profile picture or choose one of the following</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtpc-agant-dashboard-form-upload-img">
							<div class="image">
								<img src="<?php echo RTPC_ASSETS_URL . 'assets/admin/img/profile.png';?>"  height="210" width="auto"/>
								<div>*minimum 270px x 270px</div>
							</div>
							<div class="buttons">
								<a href="#" class="rtpc-agant-dashboard-btn purple">UPLOAD IMAGE</a>
								<a href="#" class="rtpc-agant-dashboard-btn red">REMOVE IMAGE</a>
							</div>
						</div>
					</div>
				</div>
				<div class="separator"></div>
				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Agent Details</label>
						<span class="subtitle">Add your contact information</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>First Name</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Last Name</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Phone</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Mobile</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Email</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Agent Position</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Website</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Address</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Fax</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Skype ID</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Agent Language</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Agent Experience</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-12 rtpc-agant-dashboard-form-element">
								<label>About</label>
								<textarea></textarea>
							</div>
							
						</div>	
						

					</div>	
				</div>
				<div class="separator"></div>
				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Agent social link</label>
						<span class="subtitle">Add your Social link</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Facebook URL</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Skype URL</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>YouTube URL</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Linkedin URL</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Google Plus Url</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Pinterest Url</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Twitter URL</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Instagram URL</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Vimeo URL</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Website URL</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-12 rtpc-agant-dashboard-form-btns">
								<a href="#" class="rtpc-agant-dashboard-btn purple">UPDATE PROFILE</a>
							</div>	
						</div>	
					</div>	
				</div>	
				<div class="separator"></div>
				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Change password</label>
						<span class="subtitle">*After you change the password you will have to login again.</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content">
						<div class="rtp-row">
							<div class="rtp-col-md-12 rtpc-agant-dashboard-form-element">
								<label>Old Password</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>New Password</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-6 rtpc-agant-dashboard-form-element">
								<label>Confirm New Password</label>
								<input type="text"  />
							</div>
							<div class="rtp-col-md-12 rtpc-agant-dashboard-form-btns">
								<a href="#" class="rtpc-agant-dashboard-btn purple">UPDATE PASSWORD</a>
								<a href="#" class="rtpc-agant-dashboard-btn blue">RESET PASSWORD</a>
							</div>	
						</div>	
					</div>	
				</div>	
				<div class="separator"></div>
				<div class="rtpc-agant-dashboard-form-section rtp-row">
					<div class="rtp-col-md-4 rtpc-agant-dashboard-form-section-title">
						<label class="title">Delete Account</label>
						<span class="subtitle">*After you change the password</span>
					</div>
					<div class="rtp-col-md-8 rtpc-agant-dashboard-form-section-content rtpc-agant-dashboard-align-right">
						<a href="#" class="rtpc-agant-dashboard-btn red">Delete MY Account</a>
					</div>	
				</div>	
			</div>

		</div>	
	</div>
</div>	










