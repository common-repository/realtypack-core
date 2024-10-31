-- Add columns for agent and agency
ALTER TABLE `#__wpl_users` ADD `r_facebook` varchar(255) NULL;
ALTER TABLE `#__wpl_users` ADD `r_twitter` varchar(255) NULL;
ALTER TABLE `#__wpl_users` ADD `r_pinterest` varchar(255) NULL;
ALTER TABLE `#__wpl_users` ADD `r_skype` varchar(255) NULL;
ALTER TABLE `#__wpl_users` ADD `agent_cover` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
ALTER TABLE `#__wpl_users` ADD `rtp_agent_list` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
ALTER TABLE `#__wpl_users` ADD `rtp_agency_establish` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

-- add agent field
INSERT INTO `#__wpl_dbst` (`id`, `kind`, `mandatory`, `name`, `type`, `options`, `enabled`, `pshow`, `plisting`, `searchmod`, `editable`, `deletable`, `index`, `css`, `style`, `specificable`, `listing_specific`, `property_type_specific`, `table_name`, `table_column`, `category`, `rankable`, `rank_point`, `comments`, `pwizard`, `text_search`, `params`) VALUES
(10101, 2, 0, 'Facebook', 'text', '', 1, '1', 1, 0, 0, 0, 5.00, '', '', 1, '', '', 'wpl_users', 'r_facebook', 10, 1, 0, NULL, '1', 1, ''), 
(10102, 2, 0, 'Twitter', 'text', '', 1, '1', 1, 0, 0, 0, 5.10, '', '', 1, '', '', 'wpl_users', 'r_twitter', 10, 1, 0, NULL, '1', 1, ''),
(10103, 2, 0, 'pinterest', 'text', '', 1, '1', 1, 0, 0, 0, 5.20, '', '', 1, '', '', 'wpl_users', 'r_pinterest', 10, 1, 0, NULL, '1', 1, ''),
(10104, 2, 0, 'Skype', 'text', '', 1, '1', 1, 0, 0, 0, 5.20, '', '', 1, '', '', 'wpl_users', 'r_skype', 10, 1, 0, NULL, '1', 1, ''),
(4104, 2, 0, 'Cover Image', 'upload', '{"params":{"request_str":"?wpl_format=b:users:ajax&wpl_function=upload_file&file_name=[html_element_id]&item_id=[item_id]"},"preview":1,"remove_str":"wpl_format=b:users:ajax&wpl_function=delete_file&item_id=[item_id]"}', 1, '0', 0, 0, 0, 0, 5.30, '', '', 0, '', '', 'wpl_users', 'agent_cover', 10, 0, 0, '', '1', 0, '');

-- Agency Field
INSERT INTO `#__wpl_dbst` (`id`, `kind`, `mandatory`, `name`, `type`, `options`, `enabled`, `pshow`, `pdf`, `plisting`, `searchmod`, `editable`, `deletable`, `index`, `css`, `style`, `specificable`, `user_specific`, `table_name`, `table_column`, `category`) VALUES
(4105, 2, 0, 'Agent List', 'multiselect_agent', '', 1, 1, 1, 0, 1, 0, 0, 4105, '', '', 1, '4,', 'wpl_users', 'rtp_agent_list', 10),
(4106, 2, 0, 'Established Date', 'date', '', 1, 1, 1, 0, 1, 0, 0, 4106, '', '', 1, '4,', 'wpl_users', 'rtp_agency_establish', 10);


-- Inset group types
INSERT INTO `#__wpl_users` (`id`, `membership_name`, `membership_id`, `membership_type`, `index`, `access_propertywizard`, `access_propertyshow`, `access_propertylisting`, `access_profilewizard`, `access_confirm`, `access_propertymanager`, `access_delete`, `access_public_profile`, `access_change_user`, `access_receive_notifications`, `first_name`, `last_name`, `about`, `company_name`, `company_address`, `website`, `main_email`, `secondary_email`, `sex`, `tel`, `fax`, `mobile`, `languages`, `location1_id`, `location2_id`, `location3_id`, `location4_id`, `location5_id`, `location6_id`, `location7_id`, `location1_name`, `location2_name`, `location3_name`, `location4_name`, `location5_name`, `location6_name`, `location7_name`, `zip_id`, `zip_name`, `maccess_num_prop`, `maccess_num_feat`, `maccess_num_hot`, `maccess_num_pic`, `maccess_period`, `maccess_price`, `maccess_price_unit`, `maccess_lrestrict`, `maccess_listings`, `maccess_ptrestrict`, `maccess_property_types`, `maccess_renewable`, `maccess_renewal_price`, `maccess_renewal_price_unit`, `maccess_upgradable`, `maccess_upgradable_to`, `maccess_short_description`, `maccess_long_description`, `maccess_wpl_color`, `expired`, `expiry_date`, `textsearch`, `location_text`, `rendered`, `last_modified_time_stamp`, `profile_picture`, `company_logo`) VALUES
(-3, 'Agency', -3, 4, 100.00, 0, 1, 1, 0, 0, 0, 0, 0, 0, 1, '', '', NULL, '', '', '', '', '', 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', 0, 0, 0, 0, '', NULL, NULL, NULL, 0, NULL, '', NULL, '', '0000-00-00 00:00:00', '', '');

INSERT INTO `#__wpl_user_group_types` (`id`, `name`, `default_membership_id`, `editable`, `deletable`, `index`, `params`, `enabled`) VALUES (4, 'Agency', -3,0, 0, 4.0, NULL, 1);