-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2019 at 07:31 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_oes_l58_wservices_wo_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicprofiles`
--

CREATE TABLE `academicprofiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `examination_passed` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `university` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `passed_out_year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `marks_obtained` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `activity_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(199) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `tags` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `item_type` enum('questions') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'questions',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `couponcodes`
--

CREATE TABLE `couponcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount_type` enum('value','percent') COLLATE utf8_unicode_ci NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `minimum_bill` decimal(10,2) NOT NULL,
  `discount_maximum_amount` decimal(10,2) NOT NULL,
  `valid_from` date NOT NULL,
  `valid_to` date NOT NULL,
  `usage_limit` int(11) NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `coupon_code_applicability` text COLLATE utf8_unicode_ci,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `couponcodes_usage`
--

CREATE TABLE `couponcodes_usage` (
  `id` bigint(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_cost` decimal(10,2) NOT NULL,
  `total_invoice_amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplates`
--

CREATE TABLE `emailtemplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('header','footer','content') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'content',
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `from_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_updated_by` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emailtemplates`
--

INSERT INTO `emailtemplates` (`id`, `title`, `slug`, `type`, `subject`, `content`, `from_email`, `from_name`, `record_updated_by`, `created_at`, `updated_at`) VALUES
(1, 'header', 'header', 'header', 'header', '<p>Email</p>\r\n\r\n<div class=\"block\"><!-- Start of preheader -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n				<tbody><!-- Spacing -->\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<!-- Spacing -->\r\n					<tr>\r\n						<td>If you cannot read this email, please <a class=\"hlite\" href=\"#\" style=\"text-decoration: none; color: #0db9ea\"> click here </a></td>\r\n					</tr>\r\n					<!-- Spacing -->\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<!-- Spacing -->\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!-- End of preheader --></div>\r\n\r\n<div class=\"block\"><!-- start of header -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"border-bottom:1px solid #0db9ea; width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td><!-- logo -->\r\n						<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:280px\">\r\n							<tbody>\r\n								<tr>\r\n									<td>\r\n									<div class=\"imgpop\"><a href=\"#\"><img alt=\"logo\" class=\"logo\" src=\"http://conquerorslabs.com/exam2/public/uploads/settings/eKFhxlkXcMtX5xW.png\" style=\"border:none; display:block; outline:none; text-decoration:none\" /> </a></div>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						<!-- End of logo --><!-- menu -->\r\n\r\n						<table align=\"right\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:280px\">\r\n							<tbody>\r\n								<tr>\r\n									<td><a href=\"#\" style=\"text-decoration: none; color: #ffffff;\">HOME </a> | <a href=\"#\" style=\"text-decoration: none; color: #ffffff;\"> ABOUT </a> | <a href=\"#\" style=\"text-decoration: none; color: #ffffff;\"> SHOP </a></td>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						<!-- End of Menu --></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!-- end of header --></div>\r\n', 'no@noemail.com', 'Test', 1, '2016-07-19 06:23:14', '2016-10-18 14:24:33'),
(2, 'footer', 'footer', 'footer', 'footer', '<div class=\"block\">\r\n    <!-- Start of preheader -->\r\n    <table bgcolor=\"#f6f4f5\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" st-sortable=\"postfooter\" width=\"100%\">\r\n        <tbody>\r\n            <tr>\r\n                <td width=\"100%\">\r\n                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" width=\"580\">\r\n                        <tbody>\r\n                            <!-- Spacing -->\r\n                            <tr>\r\n                                <td height=\"5\" width=\"100%\">\r\n                                </td>\r\n                            </tr>\r\n                            <!-- Spacing -->\r\n                            <tr>\r\n                                <td align=\"center\" st-content=\"preheader\" style=\"font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999\" valign=\"middle\">\r\n                                    If you don\'t want to receive updates. please\r\n                                    <a class=\"hlite\" href=\"#\" style=\"text-decoration: none; color: #0db9ea\">\r\n                                        unsubscribe\r\n                                    </a>\r\n                                </td>\r\n                            </tr>\r\n                            <!-- Spacing -->\r\n                            <tr>\r\n                                <td height=\"5\" width=\"100%\">\r\n                                </td>\r\n                            </tr>\r\n                            <!-- Spacing -->\r\n                        </tbody>\r\n                    </table>\r\n                </td>\r\n            </tr>\r\n        </tbody>\r\n    </table>\r\n    <!-- End of preheader -->\r\n</div>', 'no@noemail.com', 'Test', 2, '2016-07-19 06:24:08', '2016-07-19 06:30:21'),
(3, 'exam-result', 'exam-result', 'content', 'Exam Result', '<div class=\"block\">\r\n   <!-- Full + text -->\r\n   <table width=\"100%\" bgcolor=\"#f6f4f5\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"fullimage\">\r\n      <tbody>\r\n         <tr>\r\n            <td>\r\n               <table bgcolor=\"#ffffff\" width=\"580\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"devicewidth\" modulebg=\"edit\">\r\n                  <tbody>\r\n                     <tr>\r\n                        <td width=\"100%\" height=\"20\"></td>\r\n                     </tr>\r\n                     <tr>\r\n                        <td>\r\n                           <table width=\"540\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"devicewidthinner\">\r\n                              <tbody>\r\n                                 <!-- title -->\r\n                                 <tr>\r\n                                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #333333; text-align:left;line-height: 20px;\" st-title=\"rightimage-title\"> LOREM IPSUM </td>\r\n                                 </tr>\r\n                                 <!-- end of title -->\r\n                                 <!-- Spacing -->\r\n                                 <tr>\r\n                                    <td width=\"100%\" height=\"10\"></td>\r\n                                 </tr>\r\n                                 <!-- Spacing -->\r\n                                 <!-- content -->\r\n                                 <tr>\r\n                                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #666666; text-align:left;line-height: 24px;\" st-content=\"rightimage-paragraph\"> {{ $content }} </td>\r\n                                 </tr>\r\n                                 <!-- end of content -->\r\n                                 <!-- Spacing -->\r\n                                 <tr>\r\n                                    <td width=\"100%\" height=\"10\"></td>\r\n                                 </tr>\r\n                                 \r\n                                 <!-- Spacing -->\r\n                                 <tr>\r\n                                    <td width=\"100%\" height=\"10\"></td>\r\n                                 </tr>\r\n                                 <!-- button -->\r\n                                 <tr>\r\n                                    <td>\r\n                                       <table height=\"30\" align=\"left\" valign=\"middle\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" st-button=\"edit\">\r\n                                          <tbody>\r\n                                             <tr>\r\n                                                <td width=\"auto\" align=\"center\" valign=\"middle\" height=\"30\" style=\" background-color:#0db9ea; border-top-left-radius:4px; border-bottom-left-radius:4px;border-top-right-radius:4px; border-bottom-right-radius:4px; background-clip: padding-box;font-size:13px; font-family:Helvetica, arial, sans-serif; text-align:center;  color:#ffffff; font-weight: 300; padding-left:18px; padding-right:18px;\"> <span style=\"color: #ffffff; font-weight: 300;\">\r\n                                                   <a style=\"color: #ffffff; text-align:center;text-decoration: none;\" href=\"#\">Read More</a>\r\n                                                   </span> \r\n                                                </td>\r\n                                             </tr>\r\n                                          </tbody>\r\n                                       </table>\r\n                                    </td>\r\n                                 </tr>\r\n                                 <!-- /button -->\r\n                                 <!-- Spacing -->\r\n                                 <tr>\r\n                                    <td width=\"100%\" height=\"20\"></td>\r\n                                 </tr>\r\n                                 <!-- Spacing -->\r\n                              </tbody>\r\n                           </table>\r\n                        </td>\r\n                     </tr>\r\n                  </tbody>\r\n               </table>\r\n            </td>\r\n         </tr>\r\n      </tbody>\r\n   </table>\r\n</div>', 'admin@gmail.com', 'Test', 2, '2016-07-19 06:37:51', '2016-07-19 06:37:51'),
(4, 'registration', 'registration', '', 'Welcome', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear {{ $username }},<br />\r\n									You have successfully registered with Academia. Enjoy the facilities provided by our system.</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@academia.com', 'Academia Admin', 1, '2016-07-29 03:48:18', '2016-10-19 20:10:05'),
(5, 'subscription', 'subscription', '', 'Subscription Successfull', '<div class=\"block\"><!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">Dear {{ $username }},<br />\r\n									You have successfully subscribed to {{ ucfirst($plan)}} plan with transaction {{$id}}. Enjoy the facilities provided by our system.</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:center\"><span style=\"color:#ffffff\"><a href=\"#\" style=\"color: #ffffff; text-align:center;text-decoration: none;\">Read More</a> </span></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n', 'admin@academia.com', 'Jack', 1, '2016-08-03 01:00:58', '2016-09-03 01:59:12'),
(6, 'offline_subscription_failed', 'offline-subscription-failed', '', 'Offline Subscription Failed', '<div class=\"block\"><!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear {{ $username }},<br />\r\n									Your attempt for offline subscription to {{ ucfirst($plan)}} plan is failed.</p>\r\n\r\n									<p>Please find the admin comment</p>\r\n\r\n									<p><u><strong>Admin Comment:</strong></u></p>\r\n\r\n									<p>&nbsp;{{$admin_comment}}.</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:center\"><span style=\"color:#ffffff\"><a href=\"#\" style=\"color: #ffffff; text-align:center;text-decoration: none;\">Read More</a> </span></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n', 'admin@academia.com', 'Admin', 1, '2016-10-15 10:31:47', '2016-10-18 14:36:14'),
(7, 'offline_subscription_success', 'offline-subscription-success', '', 'Offline Subscription Success', '<div class=\"block\"><!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear {{ $username }},<br />\r\n									Your attempt for offline subscription to {{ ucfirst($plan)}} plan is success. &nbsp;</p>\r\n\r\n									<p><u><strong>Admin Comment</strong></u></p>\r\n\r\n									<p>&nbsp;{{$admin_comment}}.</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color: rgb(13, 185, 234); text-align: justify;\"><span style=\"color:#ffffff\"><a href=\"#\" style=\"color: #ffffff; text-align:center;text-decoration: none;\">Read More</a> </span></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n', 'admin@academia.com', 'Admin', 1, '2016-10-15 10:35:32', '2016-10-18 14:27:15'),
(8, 'subscription_success', 'subscription-success', '', 'Your Subscription was Success', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear {{ $username }},<br />\r\n									Your subscription to {{ ucfirst($plan)}} plan is success. &nbsp;</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@academia.com', 'Admin', 1, '2016-10-19 15:31:21', '2016-10-19 15:31:21'),
(9, 'forgotpassword', 'forgotpassword', 'content', 'Forgot Password', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear {{ $username }},<br />\r\n									Please reset your password by&nbsp;&nbsp; <a href=\"{{ $changepassword_link }}\" target=\"_blank\"> Click Here </a></p>\r\n\r\n									<p>&nbsp;</p>\r\n\r\n									<p>{{ $site_title }}</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@academia.com', 'Admin', 0, NULL, NULL),
(10, 'usercontactus', 'usercontactus-9', 'content', 'User Contact', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear ,<br />\r\n									Your subscription to plan is success. &nbsp;</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@admin.com', 'Admin', 21753, '2018-04-02 03:51:17', '2018-04-02 03:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `examlanguages`
--

CREATE TABLE `examlanguages` (
  `id` bigint(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `examlanguages`
--

INSERT INTO `examlanguages` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Telugu', NULL, NULL),
(2, 'Hindi', NULL, NULL),
(3, 'Tamil', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `examseries`
--

CREATE TABLE `examseries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `cost` decimal(10,2) NOT NULL,
  `validity` int(11) NOT NULL,
  `total_exams` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examseries_data`
--

CREATE TABLE `examseries_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `examseries_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examtoppers`
--

CREATE TABLE `examtoppers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `percentage` decimal(10,2) NOT NULL,
  `rank` int(11) NOT NULL,
  `quiz_result_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `examtypes`
--

CREATE TABLE `examtypes` (
  `id` bigint(20) NOT NULL,
  `code` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `examtypes`
--

INSERT INTO `examtypes` (`id`, `code`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'NSNT', 'No Section No Timer', 'No section and no timer will be shown', 1, NULL, '2018-04-04 07:51:18'),
(2, 'SNT', 'Section with No Timer', 'Section with no timer', 1, NULL, '2018-03-26 10:26:46'),
(3, 'ST', 'Section with Timer', 'Section with Timer', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faqcategories`
--

CREATE TABLE `faqcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `question` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `slug` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `answer` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `read_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `percentage_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `percentage_from` decimal(10,2) NOT NULL,
  `percentage_to` decimal(10,2) NOT NULL,
  `grade_points` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE `instructions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `instructions`
--

INSERT INTO `instructions` (`id`, `title`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(1, 'General Instructions', 'general-instructions', '<p><strong>Please read these instructions carefully.</strong> A&nbsp;candidate who breaches any of the Examination Regulations will be liable to disciplinary action including (but not limited to) suspension or expulsion from the University.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Timings</strong></p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Examinations will be conducted during the allocated times shown in the examination timetable.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The examination hall will be open for admission <strong>10 minutes </strong>before the time scheduled for the commencement of the examination. You are to find your allocated seat but&nbsp;do<strong>&nbsp;NOT </strong>turn over the question paper until instructed at the time of commencement of the examination.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You will not be admitted for the examination after <strong>one hour</strong> of the commencement of the examination.</p>\r\n\r\n<p><strong>Personal Belongings</strong></p>\r\n\r\n<ul>\r\n	<li>All your personal belongings (such as bags, pouches, ear/headphones, laptops etc.) must be placed at the designated area outside the examination hall. Please do not bring any valuable belongings except the essential materials required for the examinations.&nbsp;\r\n	<ul>\r\n		<li>Any unauthorised materials, such as books, paper, documents, pictures and electronic devices with communication and/or storage capabilities such as tablet PC, laptop, smart watch, portable audio/video/gaming devices etc. are not to be brought into the examination hall.</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Handphones brought into the examination hall must be switched off at ALL times.</strong> If your handphone is found to be switched on in the examination hall, the handphone will be confiscated and retained for investigation of possible violation of regulations.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Photography is&nbsp;<strong>NOT</strong> allowed in the examination hall at&nbsp;<strong>ALL </strong>times.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; All materials and/or devices which are found in violation of any examination regulations will be confiscated.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The University will not be responsible for the loss or damage of any belongings in or outside the examination hall.</p>\r\n\r\n<p><strong>At the Start of the Examination</strong></p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Do&nbsp;NOT </strong>turn over the question paper placed on your desk until instructed to do so at the time of commencement of the examination.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Please place your identification documents (such as matric card, identity card, passport, driving licence or EZ-Link concession card) at the top right corner of your examination desk for the marking of attendance and verification of identity during the examination.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Please check that you have the correct question paper and read the instructions printed on your examination question paper carefully.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; All examinations are anonymous. Therefore, do not write your name on the answer book. You should write only your matriculation number, correctly and legibly, in the space provided on the cover of each answer book. Providing incorrect/illegible matriculation number could risk your answer book being considered void.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n\r\n<p><strong>During Examination</strong></p>\r\n\r\n<ul>\r\n	<li>You are not allowed to communicate by word of mouth or otherwise with other candidates (this includes the time when answer scripts are being collected).</li>\r\n	<li>Please raise your hand if you wish to communicate with an invigilator.</li>\r\n</ul>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Unless granted permission by an invigilator, you are not allowed to leave your seat.</p>\r\n\r\n<ul>\r\n	<li>Once you have entered the examination hall, you will not be allowed to leave the hall&nbsp;until<strong> one hour</strong><br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; after the examination has commenced.&nbsp;</li>\r\n	<li>If, for any reason, you are given permission to leave the hall temporarily, you must be accompanied<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;by an invigilator throughout your absence from the examination hall. <strong>You are required to leave<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; your&nbsp;</strong><strong>handphone on your desk when you leave the hall temporarily.</strong></li>\r\n</ul>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; All answers, with the exception of graphs, sketches, diagrams, etc. should be written in black or blue pen, unless otherwise specified. Answers written in pencil will not be marked. The blank pages in the answer book are to be used only for candidates&#39; rough work. Solutions or any other materials written on these blank pages will not be marked.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Do not write on, mark, highlight or deface any reference materials provided for the examination. If found doing so, the reference materials will be removed from your use for the rest of the examination and you will be made to pay for the cost of the materials that have to be replaced.</p>\r\n\r\n<p><strong>At the End of the Examination</strong></p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You are&nbsp;<strong>NOT</strong> allowed to leave the examination hall during the last <strong>15 minutes</strong> of the examination and during the collection of the answer scripts. All candidates must remain seated throughout this period for invigilators to properly account for all answer scripts to be collected.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Do <strong>NOT </strong>continue to write after the examination has ended. You are to <strong>remain seated quietly</strong>&nbsp;while your answer scripts are being collected and counted.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No papers, used or unused, may be removed from the examination hall. You may take your own question paper with you unless otherwise instructed.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You are to stay in the examination hall until the Chief Invigilator has given the permission to leave. Do <strong>NOT</strong> talk until you are outside of the examination hall.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You are responsible to ensure that your answer scripts are submitted at the end of the examination. If you are present for the examination and do not submit your answer script, you will be deemed to have sat for and failed the examination concerned. Any unauthorised removal of answer script or part of answer script from the examination hall would deem the answer script as null and void.</p>\r\n\r\n<p>&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Once dismissed, you should leave the examination hall quickly and quietly.&nbsp;Remember to take your personal belongings with you.&nbsp;</p>\r\n', '2016-11-14 10:18:35', '2016-11-14 10:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_rtl` int(11) NOT NULL,
  `is_default` tinyint(2) NOT NULL DEFAULT '0',
  `phrases` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `slug`, `code`, `is_rtl`, `is_default`, `phrases`, `created_at`, `updated_at`) VALUES
(3, 'Telugu', 'telugu', 'te', 0, 0, '{\"success\":\"\\u0c35\\u0c3f\\u0c1c\\u0c2f\\u0c02\",\"record_updated_successfully\":\"\\u0c30\\u0c3f\\u0c15\\u0c3e\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c35\\u0c3f\\u0c1c\\u0c2f\\u0c35\\u0c02\\u0c24\\u0c02\\u0c17\\u0c3e \\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c3f\\u0c02\\u0c1a\\u0c2c\\u0c21\\u0c3f\\u0c02\\u0c26\\u0c3f\",\"languages\":\"\\u0c2d\\u0c3e\\u0c37\\u0c32\\u0c41\",\"create\":\"\\u0c38\\u0c43\\u0c37\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"language\":\"\\u0c2d\\u0c3e\\u0c37\\u0c3e\",\"code\":\"\\u0c15\\u0c4b\\u0c21\\u0c4d\",\"is_rtl\":\"RTL \\u0c09\\u0c02\\u0c26\\u0c3f\",\"default_language\":\"\\u0c21\\u0c3f\\u0c2b\\u0c3e\\u0c32\\u0c4d\\u0c1f\\u0c4d \\u0c2d\\u0c3e\\u0c37\\u0c3e\",\"action\":\"\\u0c2f\\u0c3e\\u0c15\\u0c4d\\u0c37\\u0c28\\u0c4d\",\"site_title\":\"\\u0c38\\u0c46\\u0c56\\u0c1f\\u0c4d \\u0c36\\u0c40\\u0c30\\u0c4d\\u0c37\\u0c3f\\u0c15\",\"latest_users\":\"\\u0c24\\u0c3e\\u0c1c\\u0c3e \\u0c35\\u0c3f\\u0c28\\u0c3f\\u0c2f\\u0c4b\\u0c17\\u0c26\\u0c3e\\u0c30\\u0c41\\u0c32\\u0c41\",\"was_joined_as\":\"\\u0c17\\u0c3e \\u0c1a\\u0c47\\u0c30\\u0c3e\\u0c30\\u0c41 \\u0c1c\\u0c30\\u0c3f\\u0c17\\u0c3f\\u0c28\\u0c26\\u0c3f\",\"see_more\":\"\\u0c07\\u0c02\\u0c15\\u0c3e \\u0c1a\\u0c42\\u0c21\\u0c02\\u0c21\\u0c3f\",\"my_profile\":\"\\u0c28\\u0c3e \\u0c1c\\u0c40\\u0c35\\u0c28 \\u0c35\\u0c3f\\u0c35\\u0c30\\u0c23\",\"change_password\":\"\\u0c2a\\u0c3e\\u0c38\\u0c4d\\u0c35\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c1a\\u0c02\\u0c21\\u0c3f\",\"logout\":\"\\u0c32\\u0c3e\\u0c17\\u0c4c\\u0c1f\\u0c4d\",\"dashboard\":\"\\u0c21\\u0c3e\\u0c37\\u0c4d\\u0c2c\\u0c4b\\u0c30\\u0c4d\\u0c21\\u0c4d\",\"users\":\"\\u0c35\\u0c3f\\u0c28\\u0c3f\\u0c2f\\u0c4b\\u0c17\\u0c26\\u0c3e\\u0c30\\u0c41\\u0c32\\u0c41\",\"roles\":\"\\u0c2a\\u0c3e\\u0c24\\u0c4d\\u0c30\\u0c32\\u0c41\",\"fee_settings\":\"\\u0c2b\\u0c40\\u0c1c\\u0c41 \\u0c38\\u0c46\\u0c1f\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c17\\u0c41\\u0c32\\u0c41\",\"fee_categories\":\"\\u0c2b\\u0c40\\u0c1c\\u0c41 \\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02\",\"fee_category_allotment\":\"\\u0c2b\\u0c40\\u0c1c\\u0c41 \\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02 \\u0c05\\u0c32\\u0c3e\\u0c1f\\u0c4d\\u0c2e\\u0c46\\u0c02\\u0c1f\\u0c4d\",\"fee_particulars\":\"\\u0c2b\\u0c40\\u0c1c\\u0c41 \\u0c35\\u0c3f\\u0c35\\u0c30\\u0c2e\\u0c41\\u0c32\",\"fee_schedules\":\"\\u0c2b\\u0c40\\u0c1c\\u0c41 \\u0c37\\u0c46\\u0c21\\u0c4d\\u0c2f\\u0c42\\u0c32\\u0c4d\\u0c38\\u0c4d\",\"fines\":\"\\u0c2b\\u0c46\\u0c56\\u0c28\\u0c4d\\u0c38\\u0c4d\",\"discounts\":\"\\u0c21\\u0c3f\\u0c38\\u0c4d\\u0c15\\u0c4c\\u0c02\\u0c1f\\u0c4d\",\"master_settings\":\"\\u0c2e\\u0c3e\\u0c38\\u0c4d\\u0c1f\\u0c30\\u0c4d \\u0c38\\u0c46\\u0c1f\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c17\\u0c41\\u0c32\\u0c41\",\"religions_master\":\"\\u0c2e\\u0c24\\u0c3e\\u0c32\\u0c41 \\u0c2e\\u0c3e\\u0c38\\u0c4d\\u0c1f\\u0c30\\u0c4d\",\"academics_master\":\"\\u0c35\\u0c3f\\u0c26\\u0c4d\\u0c2f\\u0c3e\\u0c35\\u0c47\\u0c24\\u0c4d\\u0c24\\u0c32\\u0c41 \\u0c2e\\u0c3e\\u0c38\\u0c4d\\u0c1f\\u0c30\\u0c4d\",\"courses_master\":\"\\u0c15\\u0c4b\\u0c30\\u0c4d\\u0c38\\u0c41\\u0c32\\u0c41 \\u0c2e\\u0c3e\\u0c38\\u0c4d\\u0c1f\\u0c30\\u0c4d\",\"subjects_master\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c2e\\u0c41 \\u0c2e\\u0c3e\\u0c38\\u0c4d\\u0c1f\\u0c30\\u0c4d\",\"subject_topics\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c02 \\u0c1f\\u0c3e\\u0c2a\\u0c3f\\u0c15\\u0c4d\\u0c38\\u0c4d\",\"course_subjects\":\"\\u0c15\\u0c4b\\u0c30\\u0c4d\\u0c38\\u0c41 \\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c2e\\u0c41\",\"email_templates\":\"\\u0c07\\u0c2e\\u0c46\\u0c2f\\u0c3f\\u0c32\\u0c4d \\u0c1f\\u0c46\\u0c02\\u0c2a\\u0c4d\\u0c32\\u0c47\\u0c1f\\u0c4d\\u0c32\\u0c28\\u0c41\",\"exams\":\"\\u0c2a\\u0c30\\u0c40\\u0c15\\u0c4d\\u0c37\\u0c32\\u0c41\",\"categories\":\"\\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02\",\"question_bank\":\"\\u0c2a\\u0c4d\\u0c30\\u0c36\\u0c4d\\u0c28 \\u0c2c\\u0c4d\\u0c2f\\u0c3e\\u0c02\\u0c15\\u0c4d\",\"quiz\":\"\\u0c15\\u0c4d\\u0c35\\u0c3f\\u0c1c\\u0c4d\",\"lms\":\"LMS\",\"content\":\"\\u0c15\\u0c02\\u0c1f\\u0c46\\u0c02\\u0c1f\\u0c4d\",\"study_materials\":\"\\u0c38\\u0c4d\\u0c1f\\u0c21\\u0c40 \\u0c2e\\u0c46\\u0c1f\\u0c40\\u0c30\\u0c3f\\u0c2f\\u0c32\\u0c4d\\u0c38\\u0c4d\",\"library\":\"\\u0c32\\u0c46\\u0c56\\u0c2c\\u0c4d\\u0c30\\u0c30\\u0c40\",\"asset_types\":\"\\u0c06\\u0c38\\u0c4d\\u0c24\\u0c3f \\u0c30\\u0c15\\u0c3e\\u0c32\\u0c41\",\"master_data\":\"\\u0c2e\\u0c41\\u0c16\\u0c4d\\u0c2f \\u0c38\\u0c2e\\u0c3e\\u0c1a\\u0c3e\\u0c30\",\"publishers\":\"\\u0c2a\\u0c2c\\u0c4d\\u0c32\\u0c3f\\u0c37\\u0c30\\u0c4d\\u0c38\\u0c4d\",\"authors\":\"\\u0c30\\u0c1a\\u0c2f\\u0c3f\\u0c24\\u0c32\\u0c41\",\"students\":\"\\u0c38\\u0c4d\\u0c1f\\u0c42\\u0c21\\u0c46\\u0c02\\u0c1f\\u0c4d\\u0c38\\u0c4d\",\"staff\":\"\\u0c38\\u0c4d\\u0c1f\\u0c3e\\u0c2b\\u0c4d\",\"school_hub\":\"\\u0c38\\u0c4d\\u0c15\\u0c42\\u0c32\\u0c4d \\u0c39\\u0c2c\\u0c4d\",\"attendance\":\"\\u0c39\\u0c3e\\u0c1c\\u0c30\\u0c41\",\"edit\":\"\\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c1a\\u0c41\",\"delete\":\"\\u0c24\\u0c4a\\u0c32\\u0c17\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"enable\":\"\\u0c2a\\u0c4d\\u0c30\\u0c3e\\u0c30\\u0c02\\u0c2d\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"set_default\":\"\\u0c38\\u0c46\\u0c1f\\u0c4d \\u0c21\\u0c3f\\u0c2b\\u0c3e\\u0c32\\u0c4d\\u0c1f\\u0c4d\",\"disable\":\"\\u0c21\\u0c3f\\u0c38\\u0c47\\u0c2c\\u0c41\\u0c32\\u0c4d\",\"admin_dashboard\":\"\\u0c05\\u0c21\\u0c4d\\u0c2e\\u0c3f\\u0c28\\u0c4d \\u0c21\\u0c3e\\u0c37\\u0c4d\\u0c2c\\u0c4b\\u0c30\\u0c4d\\u0c21\\u0c4d\",\"overall_users\":\"\\u0c2e\\u0c4a\\u0c24\\u0c4d\\u0c24\\u0c02\\u0c2e\\u0c40\\u0c26 \\u0c35\\u0c3f\\u0c28\\u0c3f\\u0c2f\\u0c4b\\u0c17\\u0c26\\u0c3e\\u0c30\\u0c41\\u0c32\\u0c41\",\"user_statistics\":\"\\u0c35\\u0c3e\\u0c21\\u0c41\\u0c15\\u0c30\\u0c3f \\u0c17\\u0c23\\u0c3e\\u0c02\\u0c15\\u0c3e\\u0c32\\u0c41\",\"user_details\":\"\\u0c35\\u0c3e\\u0c21\\u0c41\\u0c15\\u0c30\\u0c3f \\u0c35\\u0c3f\\u0c35\\u0c30\\u0c3e\\u0c32\\u0c41\",\"view_all\":\"\\u0c05\\u0c28\\u0c4d\\u0c28\\u0c40 \\u0c1a\\u0c42\\u0c21\\u0c41\",\"quiz_categories\":\"\\u0c15\\u0c4d\\u0c35\\u0c3f\\u0c1c\\u0c4d \\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02\",\"quizzes\":\"\\u0c15\\u0c4d\\u0c35\\u0c3f\\u0c1c\\u0c46\\u0c38\\u0c4d\",\"subjects\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c2e\\u0c41\",\"topics\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c3e\\u0c32\\u0c41\",\"questions\":\"\\u0c2a\\u0c4d\\u0c30\\u0c36\\u0c4d\\u0c28\\u0c32\\u0c41\",\"title\":\"\\u0c36\\u0c40\\u0c30\\u0c4d\\u0c37\\u0c3f\\u0c15\",\"dueration\":\"Dueration\",\"category\":\"\\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02\",\"is_paid\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c3f\\u0c38\\u0c4d\\u0c24\\u0c41\\u0c28\\u0c4d\\u0c28\\u0c2a\\u0c4d\\u0c2a\\u0c1f\\u0c3f\\u0c15\\u0c40\",\"total_marks\":\"\\u0c2e\\u0c4a\\u0c24\\u0c4d\\u0c24\\u0c02 \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c41\\u0c32\\u0c41\",\"update_questions\":\"\\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c23 \\u0c2a\\u0c4d\\u0c30\\u0c36\\u0c4d\\u0c28\",\"free\":\"\\u0c09\\u0c1a\\u0c3f\\u0c24\",\"paid\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c3f\\u0c02\\u0c2a\\u0c41\",\"create_quiz\":\"\\u0c15\\u0c4d\\u0c35\\u0c3f\\u0c1c\\u0c4d \\u0c38\\u0c43\\u0c37\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"list\":\"\\u0c1c\\u0c3e\\u0c2c\\u0c3f\\u0c24\\u0c3e\",\"quiz_title\":\"\\u0c15\\u0c4d\\u0c35\\u0c3f\\u0c1c\\u0c4d \\u0c36\\u0c40\\u0c30\\u0c4d\\u0c37\\u0c3f\\u0c15\",\"enter_value_in_minutes\":\"\\u0c35\\u0c3f\\u0c32\\u0c41\\u0c35 \\u0c2e\\u0c3f\\u0c28\\u0c3f\\u0c1f\\u0c4d\\u0c38\\u0c4d \\u0c32\\u0c4b \\u0c0e\\u0c02\\u0c1f\\u0c30\\u0c4d\",\"it will be updated by adding the questions\":\"\\u0c07\\u0c26\\u0c3f \\u0c2a\\u0c4d\\u0c30\\u0c36\\u0c4d\\u0c28\\u0c32\\u0c41 \\u0c1c\\u0c4b\\u0c21\\u0c3f\\u0c02\\u0c1a\\u0c21\\u0c02 \\u0c26\\u0c4d\\u0c35\\u0c3e\\u0c30\\u0c3e \\u0c05\\u0c2a\\u0c4d\\u0c21\\u0c47\\u0c1f\\u0c4d \\u0c05\\u0c35\\u0c41\\u0c24\\u0c41\\u0c02\\u0c26\\u0c3f\",\"pass_percentage\":\"\\u0c09\\u0c24\\u0c4d\\u0c24\\u0c40\\u0c30\\u0c4d\\u0c23\\u0c24 \\u0c36\\u0c3e\\u0c24\\u0c02\",\"no\":\"\\u0c24\\u0c4b\\u0c2c\\u0c41\\u0c1f\\u0c4d\\u0c1f\\u0c41\\u0c35\\u0c41\\u0c32\",\"yes\":\"\\u0c05\\u0c35\\u0c41\\u0c28\\u0c41\",\"description\":\"\\u0c35\\u0c3f\\u0c35\\u0c30\\u0c23\",\"add_language\":\"\\u0c2d\\u0c3e\\u0c37\\u0c3e \\u0c1c\\u0c4b\\u0c21\\u0c3f\\u0c02\\u0c1a\\u0c02\\u0c21\\u0c3f\",\"language_title\":\"\\u0c2d\\u0c3e\\u0c37\\u0c3e \\u0c36\\u0c40\\u0c30\\u0c4d\\u0c37\\u0c3f\\u0c15\",\"language_code\":\"\\u0c2d\\u0c3e\\u0c37 \\u0c15\\u0c4b\\u0c21\\u0c4d\",\"supported_language_codes\":\"\\u0c2e\\u0c26\\u0c4d\\u0c26\\u0c24\\u0c41 \\u0c2d\\u0c3e\\u0c37 \\u0c15\\u0c4b\\u0c21\\u0c4d\\u0c32\\u0c41\",\"home\":\"\\u0c39\\u0c4b\\u0c2e\\u0c4d\",\"faqs\":\"FAQS\",\"about_us\":\"\\u0c2e\\u0c3e \\u0c17\\u0c41\\u0c30\\u0c3f\\u0c02\\u0c1a\\u0c3f\",\"contact_us\":\"\\u0c2e\\u0c2e\\u0c4d\\u0c2e\\u0c32\\u0c4d\\u0c28\\u0c3f \\u0c38\\u0c02\\u0c2a\\u0c4d\\u0c30\\u0c26\\u0c3f\\u0c02\\u0c1a\\u0c02\\u0c21\\u0c3f\",\"email\":\"\\u0c07\\u0c2e\\u0c46\\u0c2f\\u0c3f\\u0c32\\u0c4d\",\"password\":\"\\u0c2a\\u0c3e\\u0c38\\u0c4d\\u0c35\\u0c30\\u0c4d\\u0c21\\u0c4d\",\"login\":\"\\u0c32\\u0c3e\\u0c17\\u0c3f\\u0c28\\u0c4d\",\"forgot_password\":\"\\u0c2a\\u0c3e\\u0c38\\u0c4d\\u0c35\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c2e\\u0c30\\u0c3f\\u0c1a\\u0c3f\\u0c2a\\u0c4b\\u0c2f\\u0c3e\\u0c30\\u0c3e\",\"register\":\"\\u0c28\\u0c2e\\u0c4b\\u0c26\\u0c41\",\"logged_out_successfully\":\"\\u0c35\\u0c3f\\u0c1c\\u0c2f\\u0c35\\u0c02\\u0c24\\u0c02\\u0c17\\u0c3e \\u0c32\\u0c3e\\u0c17\\u0c4d \\u0c05\\u0c35\\u0c41\\u0c1f\\u0c4d\",\"edit_subject\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c3e\\u0c28\\u0c4d\\u0c28\\u0c3f \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c1a\\u0c41\",\"update\":\"\\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c23\",\"subject_title\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c02 \\u0c36\\u0c40\\u0c30\\u0c4d\\u0c37\\u0c3f\\u0c15\",\"subject_code\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c02 \\u0c15\\u0c4b\\u0c21\\u0c4d\",\"is_lab\":\"\\u0c32\\u0c4d\\u0c2f\\u0c3e\\u0c2c\\u0c4d\",\"is_elective\":\"\\u0c28\\u0c3f\\u0c2f\\u0c4b\\u0c1c\\u0c3f\\u0c24 \\u0c09\\u0c02\\u0c26\\u0c3f\",\"maximum_marks\":\"\\u0c17\\u0c30\\u0c3f\\u0c37\\u0c4d\\u0c20 \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d\",\"pass_marks\":\"\\u0c2a\\u0c3e\\u0c38\\u0c4d \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d\",\"subjects_list\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c2e\\u0c41 \\u0c1c\\u0c3e\\u0c2c\\u0c3f\\u0c24\\u0c3e\",\"sno\":\"sno\",\"subject\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f\\u0c02\",\"max_marks\":\"\\u0c2e\\u0c3e\\u0c15\\u0c4d\\u0c38\\u0c4d \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d\",\"parent\":\"\\u0c2e\\u0c3e\\u0c24\\u0c43\",\"add_user\":\"\\u0c35\\u0c3e\\u0c21\\u0c41\\u0c15\\u0c30\\u0c3f \\u0c1c\\u0c4b\\u0c21\\u0c3f\\u0c02\\u0c1a\\u0c02\\u0c21\\u0c3f\",\"name\":\"\\u0c2a\\u0c47\\u0c30\\u0c41\",\"image\":\"\\u0c1a\\u0c3f\\u0c24\\u0c4d\\u0c30\\u0c02\",\"role\":\"\\u0c2a\\u0c3e\\u0c24\\u0c4d\\u0c30\",\"view_profile\":\"\\u0c2a\\u0c4d\\u0c30\\u0c4a\\u0c2b\\u0c46\\u0c56\\u0c32\\u0c4d \\u0c1a\\u0c42\\u0c21\\u0c41\",\"update_details\":\"\\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c23 \\u0c35\\u0c3f\\u0c35\\u0c30\\u0c3e\\u0c32\\u0c41\",\"add_users\":\"\\u0c35\\u0c3f\\u0c28\\u0c3f\\u0c2f\\u0c4b\\u0c17\\u0c26\\u0c3e\\u0c30\\u0c41\\u0c32\\u0c28\\u0c41 \\u0c1c\\u0c4b\\u0c21\\u0c3f\\u0c02\\u0c1a\\u0c02\\u0c21\\u0c3f\",\"select_role\":\"\\u0c2a\\u0c3e\\u0c24\\u0c4d\\u0c30 \\u0c0e\\u0c02\\u0c1a\\u0c41\\u0c15\\u0c4b\\u0c02\\u0c21\\u0c3f\",\"user_roles\":\"\\u0c35\\u0c3e\\u0c21\\u0c41\\u0c15\\u0c30\\u0c3f \\u0c2a\\u0c3e\\u0c24\\u0c4d\\u0c30\\u0c32\\u0c41\",\"permissions\":\"\\u0c05\\u0c28\\u0c41\\u0c2e\\u0c24\\u0c41\\u0c32\\u0c41\",\"add_role\":\"\\u0c2a\\u0c3e\\u0c24\\u0c4d\\u0c30 \\u0c1c\\u0c4b\\u0c21\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"role_name\":\"\\u0c2a\\u0c3e\\u0c24\\u0c4d\\u0c30 \\u0c2a\\u0c47\\u0c30\\u0c41\",\"display_name\":\"\\u0c2a\\u0c4d\\u0c30\\u0c26\\u0c30\\u0c4d\\u0c36\\u0c3f\\u0c24 \\u0c28\\u0c3e\\u0c2e\\u0c02\",\"list_roles\":\"\\u0c1c\\u0c3e\\u0c2c\\u0c3f\\u0c24\\u0c3e \\u0c2d\\u0c3e\\u0c26\\u0c4d\\u0c2f\\u0c24\\u0c32\\u0c41\",\"submit\":\"\\u0c38\\u0c2e\\u0c30\\u0c4d\\u0c2a\\u0c3f\\u0c02\\u0c1a\\u0c02\\u0c21\\u0c3f\",\"religions\":\"\\u0c2e\\u0c24\\u0c3e\\u0c32\\u0c41\",\"pass_marks_cannot_be_greater_than_maximum_marks\":\"\\u0c2a\\u0c3e\\u0c38\\u0c4d \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d \\u0c17\\u0c30\\u0c3f\\u0c37\\u0c4d\\u0c20 \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d \\u0c15\\u0c02\\u0c1f\\u0c47 \\u0c0e\\u0c15\\u0c4d\\u0c15\\u0c41\\u0c35 \\u0c09\\u0c02\\u0c21\\u0c15\\u0c42\\u0c21\\u0c26\\u0c41\",\"please_enter_valid_maximum_marks\":\"\\u0c26\\u0c2f\\u0c1a\\u0c47\\u0c38\\u0c3f \\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41 \\u0c05\\u0c2f\\u0c4d\\u0c2f\\u0c47 \\u0c17\\u0c30\\u0c3f\\u0c37\\u0c4d\\u0c20 \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d \\u0c0e\\u0c02\\u0c1f\\u0c30\\u0c4d\",\"please_enter_valid_pass_marks\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41 \\u0c05\\u0c2f\\u0c4d\\u0c2f\\u0c47 \\u0c2a\\u0c3e\\u0c38\\u0c4d \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d \\u0c0e\\u0c02\\u0c1f\\u0c30\\u0c4d \\u0c1a\\u0c47\\u0c2f\\u0c02\\u0c21\\u0c3f\",\"deleted\":\"Deleted\",\"sorry\":\"Sorry\",\"cannot_delete_this_record_as\":\"Cannot Delete This Record As\",\"this_field_id_required\":\"\\u0c08 \\u0c2b\\u0c40\\u0c32\\u0c4d\\u0c21\\u0c4d id \\u0c05\\u0c35\\u0c38\\u0c30\\u0c02\",\"the_text_is_too_short\":\"\\u0c1f\\u0c46\\u0c15\\u0c4d\\u0c38\\u0c4d\\u0c1f\\u0c4d \\u0c1a\\u0c3e\\u0c32\\u0c3e \\u0c1a\\u0c3f\\u0c28\\u0c4d\\u0c28\\u0c26\\u0c3f\",\"the_text_is_too_long\":\"\\u0c35\\u0c1a\\u0c28\\u0c02 \\u0c1a\\u0c3e\\u0c32\\u0c3e \\u0c2a\\u0c4a\\u0c21\\u0c35\\u0c41\\u0c17\\u0c3e \\u0c09\\u0c02\\u0c26\\u0c3f\",\"this_field_is_required\":\"\\u0c08 \\u0c16\\u0c3e\\u0c33\\u0c40\\u0c28\\u0c3f \\u0c24\\u0c2a\\u0c4d\\u0c2a\\u0c28\\u0c3f\\u0c38\\u0c30\\u0c3f\\u0c17\\u0c3e \\u0c2a\\u0c42\\u0c30\\u0c3f\\u0c02\\u0c1a\\u0c35\\u0c32\\u0c46\\u0c28\\u0c41\",\"please_enter_valid_email\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41 \\u0c05\\u0c2f\\u0c4d\\u0c2f\\u0c47 \\u0c07\\u0c2e\\u0c46\\u0c2f\\u0c3f\\u0c32\\u0c4d \\u0c0e\\u0c02\\u0c1f\\u0c30\\u0c4d \\u0c1a\\u0c47\\u0c2f\\u0c02\\u0c21\\u0c3f\",\"settings\":\"\\u0c38\\u0c46\\u0c1f\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c17\\u0c41\\u0c32\\u0c41\",\"record_deleted_successfully\":\"\\u0c30\\u0c3f\\u0c15\\u0c3e\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c24\\u0c4a\\u0c32\\u0c17\\u0c3f\\u0c02\\u0c1a\\u0c3f\\u0c28 \\u0c35\\u0c3f\\u0c1c\\u0c2f\\u0c35\\u0c02\\u0c24\\u0c02\\u0c17\\u0c3e\",\"record_added_successfully\":\"\\u0c30\\u0c3f\\u0c15\\u0c3e\\u0c30\\u0c4d\\u0c21\\u0c4d \\u0c1a\\u0c47\\u0c30\\u0c4d\\u0c1a\\u0c2c\\u0c21\\u0c3f\\u0c02\\u0c26\\u0c3f \\u0c35\\u0c3f\\u0c1c\\u0c2f\\u0c35\\u0c02\\u0c24\\u0c02\\u0c17\\u0c3e\",\"exam_series\":\"\\u0c2a\\u0c30\\u0c40\\u0c15\\u0c4d\\u0c37\\u0c3e \\u0c38\\u0c3f\\u0c30\\u0c40\\u0c38\\u0c4d\",\"instructions\":\"\\u0c38\\u0c42\\u0c1a\\u0c28\\u0c32\\u0c28\\u0c41\",\"coupons\":\"\\u0c15\\u0c42\\u0c2a\\u0c28\\u0c4d\\u0c32\\u0c41\",\"add\":\"\\u0c1a\\u0c47\\u0c30\\u0c4d\\u0c1a\\u0c41\",\"contents\":\"\\u0c35\\u0c3f\\u0c37\\u0c2f \\u0c38\\u0c42\\u0c1a\\u0c3f\\u0c15\",\"series\":\"\\u0c38\\u0c3f\\u0c30\\u0c40\\u0c38\\u0c4d\",\"notifications\":\"\\u0c2a\\u0c4d\\u0c30\\u0c15\\u0c1f\\u0c28\\u0c32\\u0c41\",\"messages\":\"\\u0c38\\u0c02\\u0c26\\u0c47\\u0c36\\u0c3e\\u0c32\\u0c41\",\"feedback\":\"\\u0c05\\u0c2d\\u0c3f\\u0c2a\\u0c4d\\u0c30\\u0c3e\\u0c2f\\u0c02\",\"couponcodes\":\"Couponcodes\",\"type\":\"\\u0c30\\u0c15\\u0c02\",\"discount\":\"\\u0c21\\u0c3f\\u0c38\\u0c4d\\u0c15\\u0c4c\\u0c02\\u0c1f\\u0c4d\",\"minimum_bill\":\"\\u0c15\\u0c28\\u0c40\\u0c38 \\u0c2c\\u0c3f\\u0c32\\u0c4d\",\"maximum_discount\":\"\\u0c17\\u0c30\\u0c3f\\u0c37\\u0c4d\\u0c1f \\u0c24\\u0c17\\u0c4d\\u0c17\\u0c3f\\u0c02\\u0c2a\\u0c41\",\"limit\":\"\\u0c2a\\u0c30\\u0c3f\\u0c2e\\u0c3f\\u0c24\\u0c3f\",\"status\":\"\\u0c38\\u0c4d\\u0c25\\u0c3f\\u0c24\\u0c3f\",\"lms_categories\":\"LMS \\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02\",\"create_coupon\":\"\\u0c15\\u0c42\\u0c2a\\u0c28\\u0c4d \\u0c38\\u0c43\\u0c37\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"invalid_input\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c28\\u0c3f \\u0c07\\u0c28\\u0c4d\\u0c2a\\u0c41\\u0c1f\\u0c4d\",\"coupon_code\":\"\\u0c15\\u0c42\\u0c2a\\u0c28\\u0c4d \\u0c15\\u0c4b\\u0c21\\u0c4d\",\"value\":\"\\u0c35\\u0c3f\\u0c32\\u0c41\\u0c35\",\"percent\":\"\\u0c36\\u0c3e\\u0c24\\u0c02\",\"discount_type\":\"\\u0c21\\u0c3f\\u0c38\\u0c4d\\u0c15\\u0c4c\\u0c02\\u0c1f\\u0c4d \\u0c1f\\u0c46\\u0c56\\u0c2a\\u0c4d\",\"discount_value\":\"\\u0c21\\u0c3f\\u0c38\\u0c4d\\u0c15\\u0c4c\\u0c02\\u0c1f\\u0c4d \\u0c35\\u0c3f\\u0c32\\u0c41\\u0c35\",\"enter_value\":\"\\u0c35\\u0c3f\\u0c32\\u0c41\\u0c35 \\u0c0e\\u0c02\\u0c1f\\u0c30\\u0c4d\",\"please_enter_valid_number\":\"\\u0c26\\u0c2f\\u0c1a\\u0c47\\u0c38\\u0c3f \\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41 \\u0c05\\u0c2f\\u0c4d\\u0c2f\\u0c47 \\u0c38\\u0c02\\u0c16\\u0c4d\\u0c2f\\u0c28\\u0c41 \\u0c28\\u0c2e\\u0c4b\\u0c26\\u0c41\",\"discount_maximum_amount\":\"\\u0c21\\u0c3f\\u0c38\\u0c4d\\u0c15\\u0c4c\\u0c02\\u0c1f\\u0c4d \\u0c17\\u0c30\\u0c3f\\u0c37\\u0c4d\\u0c1f \\u0c2e\\u0c4a\\u0c24\\u0c4d\\u0c24\\u0c02\",\"valid_from\":\"\\u0c28\\u0c41\\u0c02\\u0c21\\u0c3f \\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41 \\u0c05\\u0c2f\\u0c4d\\u0c2f\\u0c47\",\"valid_to\":\"\\u0c38\\u0c2e\\u0c4d\\u0c2e\\u0c24\\u0c2e\\u0c46\\u0c56\\u0c28\",\"usage_limit\":\"\\u0c35\\u0c3e\\u0c21\\u0c41\\u0c15 \\u0c2a\\u0c30\\u0c3f\\u0c2e\\u0c3f\\u0c24\\u0c3f\",\"create_series\":\"\\u0c38\\u0c3f\\u0c30\\u0c40\\u0c38\\u0c4d\\u0c28\\u0c41 \\u0c38\\u0c43\\u0c37\\u0c4d\\u0c1f\\u0c3f\\u0c02\\u0c1a\\u0c41\",\"cost\":\"\\u0c16\\u0c30\\u0c40\\u0c26\\u0c41\",\"validity\":\"\\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41\",\"total_exams\":\"\\u0c2e\\u0c4a\\u0c24\\u0c4d\\u0c24\\u0c02 \\u0c2a\\u0c30\\u0c40\\u0c15\\u0c4d\\u0c37\\u0c32\\u0c41\",\"total_questions\":\"\\u0c2e\\u0c4a\\u0c24\\u0c4d\\u0c24\\u0c02 \\u0c2a\\u0c4d\\u0c30\\u0c36\\u0c4d\\u0c28\\u0c32\\u0c41\",\"update_quizzes\":\"\\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c23 \\u0c15\\u0c4d\\u0c35\\u0c3f\\u0c1c\\u0c4d\\u0c32\\u0c41\",\"update_series_for\":\"\\u0c28\\u0c35\\u0c40\\u0c15\\u0c30\\u0c23 \\u0c38\\u0c3f\\u0c30\\u0c40\\u0c38\\u0c4d\",\"exam_categories\":\"\\u0c2a\\u0c30\\u0c40\\u0c15\\u0c4d\\u0c37\\u0c3e \\u0c35\\u0c30\\u0c4d\\u0c17\\u0c02\",\"saved_exams\":\"\\u0c38\\u0c47\\u0c35\\u0c4d \\u0c2a\\u0c30\\u0c40\\u0c15\\u0c4d\\u0c37\\u0c32\\u0c41\",\"no_data_available\":\"\\u0c21\\u0c47\\u0c1f\\u0c3e \\u0c05\\u0c02\\u0c26\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41\\u0c32\\u0c4b \\u0c32\\u0c47\\u0c35\\u0c41\",\"remove_all\":\"\\u0c05\\u0c28\\u0c4d\\u0c28\\u0c3f \\u0c24\\u0c40\\u0c38\\u0c3f\\u0c35\\u0c46\\u0c2f\\u0c4d\",\"marks\":\"\\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c15\\u0c4d\\u0c38\\u0c4d\",\"import_excel\":\"\\u0c26\\u0c3f\\u0c17\\u0c41\\u0c2e\\u0c24\\u0c3f Excel\",\"edit_user\":\"\\u0c35\\u0c3e\\u0c21\\u0c41\\u0c15\\u0c30\\u0c3f \\u0c2e\\u0c3e\\u0c30\\u0c4d\\u0c1a\\u0c41\",\"username\":\"\\u0c2f\\u0c42\\u0c1c\\u0c30\\u0c4d \\u0c2a\\u0c47\\u0c30\\u0c41\",\"phone\":\"\\u0c2b\\u0c4b\\u0c28\\u0c4d\",\"please_enter_valid_phone_number\":\"\\u0c26\\u0c2f\\u0c1a\\u0c47\\u0c38\\u0c3f \\u0c1a\\u0c46\\u0c32\\u0c4d\\u0c32\\u0c41\\u0c2c\\u0c3e\\u0c1f\\u0c41 \\u0c05\\u0c2f\\u0c4d\\u0c2f\\u0c47 \\u0c2b\\u0c4b\\u0c28\\u0c4d \\u0c28\\u0c02\\u0c2c\\u0c30\\u0c4d \\u0c0e\\u0c02\\u0c1f\\u0c30\\u0c4d\",\"address\":\"\\u0c1a\\u0c3f\\u0c30\\u0c41\\u0c28\\u0c3e\\u0c2e\\u0c3e\"}', '2016-05-24 23:11:51', '2018-04-02 02:53:10'),
(5, 'Arbic', 'arbic', 'ar', 1, 0, '{\"exam_analysis\":\"\\u062a\\u062d\\u0644\\u064a\\u0644 \\u0627\\u0644\\u0627\\u0645\\u062a\\u062d\\u0627\\u0646\",\"analysis_by_exam\":\"\\u062a\\u062d\\u0644\\u064a\\u0644 \\u0628\\u0648\\u0627\\u0633\\u0637\\u0629 \\u0627\\u0645\\u062a\\u062d\\u0627\\u0646\",\"of\":\"\\u0645\\u0646\",\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646\",\"type\":\"\\u0627\\u0643\\u062a\\u0628\",\"dueration\":\"Dueration\",\"marks\":\"\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a\",\"attempts\":\"\\u0645\\u062d\\u0627\\u0648\\u0644\\u0627\\u062a\",\"action\":\"\\u0639\\u0645\\u0644\",\"site_title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"my_profile\":\"\\u0645\\u0644\\u0641\\u064a \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"change_password\":\"\\u062a\\u063a\\u064a\\u064a\\u0631 \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0633\\u0631\",\"logout\":\"\\u062e\\u0631\\u0648\\u062c\",\"dashboard\":\"\\u0644\\u0648\\u062d\\u0629 \\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629\",\"children\":\"\\u0627\\u0644\\u0623\\u0637\\u0641\\u0627\\u0644\",\"add\":\"\\u0625\\u0636\\u0627\\u0641\\u0629\",\"list\":\"\\u0642\\u0627\\u0626\\u0645\\u0629\",\"exams\":\"\\u0627\\u0644\\u0627\\u0645\\u062a\\u062d\\u0627\\u0646\\u0627\\u062a\",\"categories\":\"\\u0627\\u0644\\u0641\\u0626\\u0627\\u062a\",\"recent_activity\":\"\\u0622\\u062e\\u0631 \\u0646\\u0634\\u0627\\u0637\",\"home\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"faqs\":\"\\u0627\\u0644\\u0623\\u0633\\u0626\\u0644\\u0629 \\u0627\\u0644\\u0623\\u0643\\u062b\\u0631 \\u0634\\u064a\\u0648\\u0639\\u0627\",\"about_us\":\"\\u0645\\u0639\\u0644\\u0648\\u0645\\u0627\\u062a \\u0639\\u0646\\u0627\",\"contact_us\":\"\\u0627\\u062a\\u0635\\u0644 \\u0628\\u0646\\u0627\",\"email\":\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"password\":\"\\u0643\\u0644\\u0645\\u0647 \\u0627\\u0644\\u0633\\u0631\",\"login\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u062f\\u062e\\u0648\\u0644\",\"forgot_password\":\"\\u0647\\u0644 \\u0646\\u0633\\u064a\\u062a \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631\",\"register\":\"\\u062a\\u0633\\u062c\\u064a\\u0644\",\"quiz_categories\":\"\\u0645\\u0633\\u0627\\u0628\\u0642\\u0629 \\u0627\\u0644\\u0641\\u0626\\u0627\\u062a\",\"view_all\":\"\\u0645\\u0634\\u0627\\u0647\\u062f\\u0629 \\u0627\\u0644\\u0643\\u0644\",\"quizzes\":\"\\u0645\\u0633\\u0627\\u0628\\u0642\\u0627\\u062a\",\"admin_dashboard\":\"\\u0644\\u0648\\u062d\\u0629 \\u0627\\u0644\\u0645\\u0634\\u0631\\u0641\",\"overall_users\":\"\\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u0648\\u0646 \\u0627\\u0644\\u0639\\u0627\\u0645\",\"user_statistics\":\"\\u0627\\u0644\\u0627\\u062d\\u0635\\u0627\\u0626\\u064a\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"user_details\":\"\\u0628\\u064a\\u0627\\u0646\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"users\":\"\\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u064a\\u0646\",\"subjects\":\"\\u0627\\u0644\\u0645\\u0648\\u0627\\u0636\\u064a\\u0639\",\"topics\":\"\\u0627\\u0644\\u0645\\u0648\\u0627\\u0636\\u064a\\u0639\",\"questions\":\"\\u0623\\u0633\\u0626\\u0644\\u0629\",\"latest_users\":\"\\u0623\\u062d\\u062f\\u062b \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u064a\\u0646\",\"was_joined_as\":\"\\u0648\\u0642\\u062f \\u0627\\u0646\\u0636\\u0645\\u062a \\u0625\\u0644\\u0649\",\"see_more\":\"\\u0634\\u0627\\u0647\\u062f \\u0627\\u0644\\u0645\\u0632\\u064a\\u062f\",\"languages\":\"\\u0627\\u0644\\u0644\\u063a\\u0627\\u062a\",\"roles\":\"\\u0627\\u0644\\u0623\\u062f\\u0648\\u0627\\u0631\",\"fee_settings\":\"\\u0625\\u0639\\u062f\\u0627\\u062f\\u0627\\u062a \\u0631\\u0633\\u0648\\u0645\",\"fee_categories\":\"\\u0631\\u0633\\u0648\\u0645 \\u0627\\u0644\\u0641\\u0626\\u0627\\u062a\",\"fee_category_allotment\":\"\\u0631\\u0633\\u0648\\u0645 \\u0627\\u0644\\u0641\\u0626\\u0629 \\u0627\\u0644\\u062a\\u062e\\u0635\\u064a\\u0635\",\"fee_particulars\":\"\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644 \\u0627\\u0644\\u0631\\u0633\\u0648\\u0645\",\"fee_schedules\":\"\\u062c\\u062f\\u0627\\u0648\\u0644 \\u0631\\u0633\\u0648\\u0645\",\"fines\":\"\\u0627\\u0644\\u063a\\u0631\\u0627\\u0645\\u0627\\u062a\",\"discounts\":\"\\u062e\\u0635\\u0648\\u0645\\u0627\\u062a\",\"master_settings\":\"\\u0625\\u0639\\u062f\\u0627\\u062f\\u0627\\u062a \\u0645\\u0627\\u0633\\u062a\\u0631\",\"religions_master\":\"\\u0627\\u0644\\u0623\\u062f\\u064a\\u0627\\u0646 \\u0645\\u0627\\u0633\\u062a\\u0631\",\"academics_master\":\"\\u0623\\u0643\\u0627\\u062f\\u064a\\u0645\\u064a\\u0648\\u0646 \\u0645\\u0627\\u0633\\u062a\\u0631\",\"courses_master\":\"\\u0645\\u0642\\u0631\\u0631\\u0627\\u062a \\u0627\\u0644\\u0645\\u0627\\u062c\\u0633\\u062a\\u064a\\u0631\",\"subjects_master\":\"\\u0627\\u0644\\u0645\\u0648\\u0627\\u0636\\u064a\\u0639 \\u0645\\u0627\\u0633\\u062a\\u0631\",\"subject_topics\":\"\\u062a\\u062e\\u0636\\u0639 \\u0645\\u0648\\u0627\\u0636\\u064a\\u0639\",\"course_subjects\":\"\\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a \\u0628\\u0627\\u0644\\u0637\\u0628\\u0639\",\"email_templates\":\"\\u0642\\u0648\\u0627\\u0644\\u0628 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"question_bank\":\"\\u0627\\u0644\\u0628\\u0646\\u0643 \\u0633\\u0624\\u0627\\u0644\",\"quiz\":\"\\u0627\\u062e\\u062a\\u0628\\u0627\\u0631 \\u0642\\u0635\\u064a\\u0631\",\"lms\":\"LMS\",\"content\":\"\\u0645\\u062d\\u062a\\u0648\\u0649\",\"study_materials\":\"\\u0645\\u0648\\u0627\\u062f \\u062f\\u0631\\u0627\\u0633\\u064a\\u0629\",\"library\":\"\\u0645\\u0643\\u062a\\u0628\\u0629\",\"asset_types\":\"\\u0623\\u0646\\u0648\\u0627\\u0639 \\u0627\\u0644\\u0623\\u0635\\u0648\\u0644\",\"master_data\":\"\\u0627\\u0644\\u0628\\u064a\\u0627\\u0646\\u0627\\u062a \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"publishers\":\"\\u0646\\u0627\\u0634\\u0631\\u064a\",\"authors\":\"\\u0627\\u0644\\u0643\\u062a\\u0627\\u0628\",\"students\":\"\\u0627\\u0644\\u0637\\u0644\\u0627\\u0628\",\"staff\":\"\\u0627\\u0644\\u0639\\u0627\\u0645\\u0644\\u064a\\u0646\",\"school_hub\":\"\\u0645\\u062d\\u0648\\u0631 \\u0627\\u0644\\u0645\\u062f\\u0631\\u0633\\u0629\",\"attendance\":\"\\u0627\\u0644\\u062d\\u0636\\u0648\\u0631\",\"create\":\"\\u062e\\u0644\\u0642\",\"category\":\"\\u0641\\u0626\\u0629\",\"is_paid\":\"\\u0645\\u062f\\u0641\\u0648\\u0639\",\"total_marks\":\"\\u0645\\u062c\\u0645\\u0648\\u0639 \\u0627\\u0644\\u062f\\u0631\\u062c\\u0627\\u062a\",\"update_questions\":\"\\u062a\\u062d\\u062f\\u064a\\u062b \\u0627\\u0644\\u0623\\u0633\\u0626\\u0644\\u0629\",\"edit\":\"\\u062a\\u062d\\u0631\\u064a\\u0631\",\"delete\":\"\\u062d\\u0630\\u0641\",\"free\":\"\\u062d\\u0631\",\"paid\":\"\\u062f\\u0641\\u0639\",\"create_quiz\":\"\\u0625\\u0646\\u0634\\u0627\\u0621 \\u0645\\u0633\\u0627\\u0628\\u0642\\u0629\",\"quiz_title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0625\\u062e\\u062a\\u0628\\u0627\\u0631\",\"enter_value_in_minutes\":\"\\u0623\\u062f\\u062e\\u0644 \\u0627\\u0644\\u0642\\u064a\\u0645\\u0629 \\u0641\\u064a \\u062f\\u0642\\u0627\\u0626\\u0642\",\"it_will_be_updated_by_adding_the_questions\":\"\\u0641\\u0633\\u064a\\u062a\\u0645 \\u062a\\u062d\\u062f\\u064a\\u062b\\u0647 \\u0628\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0623\\u0633\\u0626\\u0644\\u0629\",\"pass_percentage\":\"\\u062a\\u0645\\u0631\\u064a\\u0631 \\u0627\\u0644\\u0646\\u0633\\u0628\\u0629 \\u0627\\u0644\\u0645\\u0626\\u0648\\u064a\\u0629\",\"no\":\"\\u0644\\u0627\",\"yes\":\"\\u0646\\u0639\\u0645 \\u0641\\u0639\\u0644\\u0627\",\"description\":\"\\u0648\\u0635\\u0641\",\"language\":\"\\u0644\\u063a\\u0629\",\"code\":\"\\u0631\\u0645\\u0632\",\"is_rtl\":\"\\u063a\\u064a\\u0631 RTL\",\"default_language\":\"\\u0627\\u0644\\u0644\\u063a\\u0629 \\u0627\\u0644\\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a\\u0629\",\"enable\":\"\\u062a\\u0645\\u0643\\u064a\\u0646\",\"disable\":\"\\u062a\\u0639\\u0637\\u064a\\u0644\",\"set_default\":\"\\u0627\\u0644\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0625\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a\",\"success\":\"\\u0646\\u062c\\u0627\\u062d\",\"record_updated_successfully\":\"\\u0633\\u062c\\u0644 \\u0627\\u0644\\u062a\\u062d\\u062f\\u064a\\u062b \\u0628\\u0646\\u062c\\u0627\\u062d\",\"deleted\":\"Deleted\",\"sorry\":\"Sorry\",\"cannot_delete_this_record_as\":\"Cannot Delete This Record As\",\"add_user\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"name\":\"\\u0627\\u0633\\u0645\",\"image\":\"\\u0635\\u0648\\u0631\\u0629\",\"role\":\"\\u062f\\u0648\\u0631\",\"update_details\":\"\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644 \\u0627\\u0644\\u062a\\u062d\\u062f\\u064a\\u062b\",\"view\":\"\\u0631\\u0623\\u064a\",\"this_field_is_required\":\"\\u0647\\u0630\\u0647 \\u0627\\u0644\\u062e\\u0627\\u0646\\u0629 \\u0645\\u0637\\u0644\\u0648\\u0628\\u0647\",\"please_enter_valid_email\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0628\\u0631\\u064a\\u062f \\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a \\u0635\\u062d\\u064a\\u062d\",\"the_text_is_too_short\":\"\\u0646\\u0635 \\u0642\\u0635\\u064a\\u0631 \\u0644\\u0644\\u063a\\u0627\\u064a\\u0629\",\"settings\":\"\",\"exam_series\":\"\\u0633\\u0644\\u0633\\u0644\\u0629 \\u0627\\u0644\\u0627\\u0645\\u062a\\u062d\\u0627\\u0646\",\"instructions\":\"\\u062a\\u0639\\u0644\\u064a\\u0645\\u0627\\u062a\",\"coupons\":\"\\u0643\\u0648\\u0628\\u0648\\u0646\\u0627\\u062a\",\"contents\":\"\\u0645\\u062d\\u062a\\u0648\\u064a\\u0627\\u062a\",\"series\":\"\\u0633\\u0644\\u0633\\u0644\\u0629\",\"notifications\":\"\\u0627\\u0644\\u0625\\u0634\\u0639\\u0627\\u0631\\u0627\\u062a\",\"messages\":\"\\u0631\\u0633\\u0627\\u0626\\u0644\",\"feedback\":\"\\u0631\\u062f\\u0648\\u062f \\u0627\\u0644\\u0641\\u0639\\u0644\",\"update_strings\":\"\\u062a\\u062d\\u062f\\u064a\\u062b \\u0633\\u0644\\u0627\\u0633\\u0644\",\"lms_categories\":\"LMS \\u0627\\u0644\\u0641\\u0626\\u0627\\u062a\",\"update\":\"\\u062a\\u062d\\u062f\\u064a\\u062b\",\"import_excel\":\"\\u0627\\u0633\\u062a\\u064a\\u0631\\u0627\\u062f \\u0625\\u0643\\u0633\\u0644\",\"start_date\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u0628\\u062f\\u0621\",\"end_date\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u0627\\u0646\\u062a\\u0647\\u0627\\u0621\",\"url\":\"\\u0631\\u0627\\u0628\\u0637\",\"couponcodes\":\"Couponcodes\",\"discount\":\"\\u062e\\u0635\\u0645\",\"minimum_bill\":\"\\u0628\\u064a\\u0644 \\u0627\\u0644\\u062d\\u062f \\u0627\\u0644\\u0623\\u062f\\u0646\\u0649\",\"maximum_discount\":\"\\u0627\\u0644\\u062e\\u0635\\u0645 \\u0627\\u0644\\u0623\\u0642\\u0635\\u0649\",\"limit\":\"\\u062d\\u062f\",\"status\":\"\\u0627\\u0644\\u062d\\u0627\\u0644\\u0629\",\"edit_user\":\"\\u062a\\u062d\\u0631\\u064a\\u0631 \\u0627\\u0644\\u0639\\u0636\\u0648\",\"the_text_is_too_long\":\"\\u0627\\u0644\\u0646\\u0635 \\u0637\\u0648\\u064a\\u0644 \\u062c\\u062f\\u0627\",\"invalid_input\":\"\\u0645\\u062f\\u062e\\u0644 \\u063a\\u064a\\u0631 \\u0635\\u0627\\u0644\\u062d\",\"select_role\":\"\\u062d\\u062f\\u062f \\u062f\\u0648\\u0631\",\"add_language\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0644\\u063a\\u0629\",\"language_title\":\"\\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0644\\u063a\\u0629\",\"language_code\":\"\\u0643\\u0648\\u062f \\u0627\\u0644\\u0644\\u063a\\u0629\",\"supported_language_codes\":\"\\u0631\\u0645\\u0648\\u0632 \\u0644\\u063a\\u0629 \\u0645\\u0639\\u062a\\u0645\\u062f\\u0629\",\"edit_language\":\"\\u062a\\u062d\\u0631\\u064a\\u0631 \\u0627\\u0644\\u0644\\u063a\\u0629\",\"add_users\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u064a\\u0646\",\"create_category\":\"\\u0625\\u0646\\u0634\\u0627\\u0621 \\u0627\\u0644\\u0641\\u0626\\u0629\",\"category_name\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u062a\\u0635\\u0646\\u064a\\u0641\",\"please_upload_valid_image_type\":\"\\u064a\\u0631\\u062c\\u0649 \\u062a\\u062d\\u0645\\u064a\\u0644 \\u0635\\u0627\\u0644\\u062d \\u0646\\u0648\\u0639 \\u0627\\u0644\\u0635\\u0648\\u0631\\u0629\",\"edit_author\":\"\\u0627\\u0644\\u0643\\u0627\\u062a\\u0628 \\u062a\\u062d\\u0631\\u064a\\u0631\",\"question_subjects\":\"\\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a \\u0627\\u0644\\u0633\\u0624\\u0627\\u0644\",\"add_subject\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\",\"subject\":\"\\u0645\\u0648\\u0636\\u0648\\u0639\",\"view_questions\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0623\\u0633\\u0626\\u0644\\u0629\",\"subject_title\":\"\\u064a\\u062e\\u0636\\u0639 \\u0639\\u0646\\u0648\\u0627\\u0646\",\"subject_code\":\"\\u0631\\u0645\\u0632 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\",\"is_lab\":\"\\u0647\\u0648 \\u0645\\u062e\\u062a\\u0628\\u0631\",\"is_elective\":\"\\u063a\\u064a\\u0631 \\u0627\\u0644\\u0627\\u062e\\u062a\\u064a\\u0627\\u0631\\u064a\\u0629\",\"maximum_marks\":\"\\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0642\\u0635\\u0648\\u0649\",\"please_enter_valid_number\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0635\\u0627\\u0644\\u062d \\u0639\\u062f\\u062f\",\"pass_marks\":\"\\u0639\\u0644\\u0627\\u0645\\u0629 \\u0645\\u0631\\u0648\\u0631\",\"please_enter_valid_maximum_marks\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0642\\u0635\\u0648\\u0649 \\u0635\\u0627\\u0644\\u062d\",\"please_enter_valid_pass_marks\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0646\\u062c\\u0627\\u062d \\u0635\\u0627\\u0644\\u062d\\u0629\",\"pass_marks_cannot_be_greater_than_maximum_marks\":\"\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0646\\u062c\\u0627\\u062d \\u0644\\u0627 \\u064a\\u0645\\u0643\\u0646 \\u0623\\u0646 \\u062a\\u0643\\u0648\\u0646 \\u0623\\u0643\\u0628\\u0631 \\u0645\\u0646 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0642\\u0635\\u0648\\u0649\",\"topic\":\"\\u0645\\u0648\\u0636\\u0648\\u0639\",\"question\":\"\\u0633\\u0624\\u0627\\u0644\",\"difficulty\":\"\\u0635\\u0639\\u0648\\u0628\\u0629\",\"subjects_list\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a\",\"max_marks\":\"\\u0645\\u0627\\u0631\\u0643\\u0633 \\u0645\\u0627\\u0643\\u0633\",\"topics_list\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0636\\u064a\\u0639\",\"parent\":\"\\u0623\\u0635\\u0644\",\"from_email\":\"\\u0645\\u0646 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u0649\",\"from_name\":\"\\u0645\\u0646 \\u0627\\u0644\\u0627\\u0633\\u0645\",\"module\":\"\\u0648\\u062d\\u062f\\u0629\",\"key\":\"\\u0645\\u0641\\u062a\\u0627\\u062d\",\"add_setting\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0648\\u0636\\u0639\",\"edit_topic\":\"\\u062a\\u062d\\u0631\\u064a\\u0631 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\",\"select_parent\":\"\\u062d\\u062f\\u062f \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\",\"topic_name\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\",\"edit_template\":\"\\u062a\\u062d\\u0631\\u064a\\u0631 \\u0642\\u0627\\u0644\\u0628\",\"welcome\":\"\\u0623\\u0647\\u0644\\u0627 \\u0628\\u0643\",\"are_you_sure\":\"\\u0647\\u0644 \\u0623\\u0646\\u062a \\u0648\\u0627\\u062b\\u0642\",\"you_will_not_be_able_to_recover_this_record\":\"\\u0623\\u0646\\u062a \\u0644\\u0646 \\u062a\\u0643\\u0648\\u0646 \\u0642\\u0627\\u062f\\u0631\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0633\\u062a\\u0631\\u062f\\u0627\\u062f \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0633\\u062c\\u0644\",\"delete_it\":\"\\u0627\\u062d\\u0630\\u0641\\u0647\",\"cancel_please\":\"\\u0625\\u0644\\u063a\\u0627\\u0621 \\u0627\\u0644\\u0631\\u062c\\u0627\\u0621\",\"your_record_has_been_deleted\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u062a\\u0645 \\u062d\\u0630\\u0641\",\"cancelled\":\"\\u062a\\u0645 \\u0627\\u0644\\u0627\\u0644\\u063a\\u0627\\u0621\",\"your_record_is_safe\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0622\\u0645\\u0646\\u0629\",\"payment_reports\":\"\\u062a\\u0642\\u0627\\u0631\\u064a\\u0631 \\u0627\\u0644\\u062f\\u0641\\u0639\",\"online_payments\":\"\\u0627\\u0644\\u0645\\u062f\\u0641\\u0648\\u0639\\u0627\\u062a \\u0639\\u0628\\u0631 \\u0627\\u0644\\u0625\\u0646\\u062a\\u0631\\u0646\\u062a\",\"offline_payments\":\"\\u0627\\u0644\\u0645\\u062f\\u0641\\u0648\\u0639\\u0627\\u062a \\u062d\\u0627\\u0644\\u064a\\u0627\",\"export\":\"\\u062a\\u0635\\u062f\\u064a\\u0631\",\"sms\":\"\\u0631\\u0633\\u0627\\u0644\\u0629 \\u0642\\u0635\\u064a\\u0631\\u0629\",\"info\":\"\\u0645\\u0639\\u0644\\u0648\\u0645\\u0627\\u062a\",\"operations_are_disabled_in_demo_version\":\"\\u0639\\u0645\\u0644\\u064a\\u0627\\u062a \\u0645\\u0639\\u0637\\u0644\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0646\\u0633\\u062e\\u0629 \\u0627\\u0644\\u062a\\u062c\\u0631\\u064a\\u0628\\u064a\\u0629\",\"exam_types\":\"\\u0623\\u0646\\u0648\\u0627\\u0639 \\u0627\\u0644\\u0627\\u0645\\u062a\\u062d\\u0627\\u0646\",\"themes\":\"\\u0627\\u0644\\u0645\\u0648\\u0627\\u0636\\u064a\\u0639\",\"please_wait\":\"\\u0623\\u0631\\u062c\\u0648 \\u0627\\u0644\\u0625\\u0646\\u062a\\u0638\\u0627\\u0631\"}', '2016-08-18 00:10:49', '2018-04-02 02:53:10');
INSERT INTO `languages` (`id`, `language`, `slug`, `code`, `is_rtl`, `is_default`, `phrases`, `created_at`, `updated_at`) VALUES
(6, 'Tamil', 'tamil', 'ta', 0, 0, '{\"success\":\"\\u0bb5\\u0bc6\\u0bb1\\u0bcd\\u0bb1\\u0bbf\",\"record_updated_successfully\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc1 \\u0bb5\\u0bc6\\u0bb1\\u0bcd\\u0bb1\\u0bbf\\u0b95\\u0bb0\\u0bae\\u0bbe\\u0b95 \\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1\",\"languages\":\"\\u0bae\\u0bc6\\u0bbe\\u0bb4\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"create\":\"\\u0b89\\u0bb0\\u0bc1\\u0bb5\\u0bbe\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"language\":\"\\u0bae\\u0bc6\\u0bbe\\u0bb4\\u0bbf\",\"code\":\"\\u0b95\\u0bc1\\u0bb1\\u0bbf\\u0baf\\u0bc0\\u0b9f\\u0bc1\",\"is_rtl\":\"\\u0bb5\\u0bb2\\u0bae\\u0bbf\\u0bb0\\u0bc1\\u0ba8\\u0bcd\\u0ba4\\u0bc1 \\u0b87\\u0b9f\\u0bae\\u0bbe\\u0b95 \\u0b87\\u0bb0\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bbf\\u0bb1\\u0ba4\\u0bc1\",\"default_language\":\"\\u0b87\\u0baf\\u0bb2\\u0bcd\\u0baa\\u0bc1\\u0ba8\\u0bbf\\u0bb2\\u0bc8 \\u0bae\\u0bc6\\u0bbe\\u0bb4\\u0bbf\",\"action\":\"\\u0b85\\u0ba4\\u0bbf\\u0bb0\\u0b9f\\u0bbf\",\"deleted\":\"\\u0ba8\\u0bc0\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\",\"sorry\":\"\\u0bae\\u0ba9\\u0bcd\\u0ba9\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"cannot_delete_this_record_as\":\"\\u0b87\\u0ba8\\u0bcd\\u0ba4 \\u0b9a\\u0bbe\\u0ba4\\u0ba9\\u0bc8\\u0baf\\u0bc8 \\u0baa\\u0bc7\\u0bbe\\u0bb2\\u0bcd \\u0ba8\\u0bc0\\u0b95\\u0bcd\\u0b95 \\u0bae\\u0bc1\\u0b9f\\u0bbf\\u0baf\\u0bbe\\u0ba4\\u0bc1\",\"site_title\":\"\\u0ba4\\u0bb3 \\u0ba4\\u0bb2\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"latest_users\":\"\\u0b9a\\u0bae\\u0bc0\\u0baa\\u0ba4\\u0bcd\\u0ba4\\u0bbf\\u0baf \\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"was_joined_as\":\"\\u0b8e\\u0ba9 \\u0b87\\u0ba3\\u0bc8\\u0ba8\\u0bcd\\u0ba4\\u0bc1 \\u0b95\\u0bc6\\u0bbe\\u0ba3\\u0bcd\\u0b9f\\u0ba9\\u0bb0\\u0bcd\",\"see_more\":\"\\u0bae\\u0bc7\\u0bb2\\u0bc1\\u0bae\\u0bcd \\u0baa\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0b95\",\"my_profile\":\"\\u0b8e\\u0ba9\\u0bcd \\u0b9a\\u0bc1\\u0baf\\u0bb5\\u0bbf\\u0bb5\\u0bb0\\u0bae\\u0bcd\",\"change_password\":\"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\\u0bb2\\u0bc8 \\u0bae\\u0bbe\\u0bb1\\u0bcd\\u0bb1\\u0bc1\",\"logout\":\"\\u0bb5\\u0bc6\\u0bb3\\u0bbf\\u0baf\\u0bc7\\u0bb1\\u0bc1\",\"dashboard\":\"\\u0b9f\\u0bbe\\u0bb7\\u0bcd\\u0baa\\u0bc7\\u0bbe\\u0bb0\\u0bcd\\u0b9f\\u0bc1\",\"users\":\"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"roles\":\"\\u0baa\\u0bbe\\u0ba4\\u0bcd\\u0ba4\\u0bbf\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"fee_settings\":\"\\u0b95\\u0b9f\\u0bcd\\u0b9f\\u0ba3\\u0bae\\u0bcd \\u0b85\\u0bae\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"fee_categories\":\"\\u0b95\\u0b9f\\u0bcd\\u0b9f\\u0ba3\\u0bae\\u0bcd \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"fee_category_allotment\":\"\\u0b95\\u0b9f\\u0bcd\\u0b9f\\u0ba3\\u0bae\\u0bcd \\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bc1 \\u0b92\\u0ba4\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc0\\u0b9f\\u0bc1\",\"fee_particulars\":\"\\u0b95\\u0b9f\\u0bcd\\u0b9f\\u0ba3\\u0bae\\u0bcd \\u0bb5\\u0bbf\\u0baa\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"fee_schedules\":\"\\u0b95\\u0b9f\\u0bcd\\u0b9f\\u0ba3\\u0bae\\u0bcd \\u0bb5\\u0bbf\\u0bae\\u0bbe\\u0ba9 \\u0b95\\u0bbe\\u0bb2 \\u0b85\\u0b9f\\u0bcd\\u0b9f\\u0bb5\\u0ba3\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"fines\":\"\\u0b85\\u0baa\\u0bb0\\u0bbe\\u0ba4\\u0bae\\u0bcd\",\"discounts\":\"\\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"master_settings\":\"\\u0bae\\u0bbe\\u0bb8\\u0bcd\\u0b9f\\u0bb0\\u0bcd \\u0b85\\u0bae\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"religions_master\":\"\\u0bae\\u0ba4\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bbe\\u0bb8\\u0bcd\\u0b9f\\u0bb0\\u0bcd\",\"academics_master\":\"\\u0b95\\u0bb2\\u0bcd\\u0bb5\\u0bbf\\u0baf\\u0bbe\\u0bb3\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bbe\\u0bb8\\u0bcd\\u0b9f\\u0bb0\\u0bcd\",\"courses_master\":\"\\u0bae\\u0bc8\\u0ba4\\u0bbe\\u0ba9\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bbe\\u0bb8\\u0bcd\\u0b9f\\u0bb0\\u0bcd\",\"subjects_master\":\"\\u0baa\\u0bbe\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bbe\\u0bb8\\u0bcd\\u0b9f\\u0bb0\\u0bcd\",\"subject_topics\":\"\\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0bb3\\u0bcd \\u0ba4\\u0bb2\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"course_subjects\":\"\\u0baa\\u0bbe\\u0b9f\\u0ba4\\u0bcd\\u0ba4\\u0bbf\\u0b9f\\u0bcd\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bc8\",\"email_templates\":\"\\u0bae\\u0bbf\\u0ba9\\u0bcd\\u0ba9\\u0b9e\\u0bcd\\u0b9a\\u0bb2\\u0bcd \\u0bb5\\u0bbe\\u0bb0\\u0bcd\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"exams\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"categories\":\"\\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"question_bank\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf \\u0bb5\\u0b99\\u0bcd\\u0b95\\u0bbf\",\"quiz\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0b9f\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe\",\"lms\":\"LMS\",\"content\":\"\\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0b9f\\u0b95\\u0bcd\\u0b95\",\"study_materials\":\"\\u0b86\\u0baf\\u0bcd\\u0bb5\\u0bc1 \\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0b9f\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"library\":\"\\u0ba8\\u0bc2\\u0bb2\\u0b95\\u0bae\\u0bcd\",\"asset_types\":\"\\u0b9a\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"master_data\":\"\\u0baa\\u0bbf\\u0bb0\\u0ba4\\u0bbe\\u0ba9 \\u0ba4\\u0bb0\\u0bb5\\u0bc1\",\"publishers\":\"\\u0baa\\u0baa\\u0bcd\\u0bb3\\u0bbf\\u0bb7\\u0bb0\\u0bcd\\u0bb8\\u0bcd\",\"authors\":\"\\u0b86\\u0b9a\\u0bbf\\u0bb0\\u0bbf\\u0baf\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"students\":\"\\u0bae\\u0bbe\\u0ba3\\u0bb5\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"staff\":\"\\u0b8a\\u0bb4\\u0bbf\\u0baf\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"school_hub\":\"\\u0baa\\u0bb3\\u0bcd\\u0bb3\\u0bbf \\u0bae\\u0bc8\\u0baf\\u0bae\\u0bcd\",\"attendance\":\"\\u0bb5\\u0bb0\\u0bc1\\u0b95\\u0bc8\",\"edit\":\"\\u0ba4\\u0bc6\\u0bbe\\u0b95\\u0bc1\",\"delete\":\"\\u0b85\\u0bb4\\u0bbf\",\"enable\":\"\\u0b87\\u0baf\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"set_default\":\"\\u0b87\\u0baf\\u0bb2\\u0bcd\\u0baa\\u0bbe\\u0b95 \\u0b85\\u0bae\\u0bc8\",\"disable\":\"\\u0bae\\u0bc1\\u0b9f\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"user_statistics\":\"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd \\u0baa\\u0bc1\\u0bb3\\u0bcd\\u0bb3\\u0bbf \\u0bb5\\u0bbf\\u0baa\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"view_all\":\"\\u0b95\\u0bbe\\u0ba3\\u0bcd\\u0b95 \\u0b85\\u0ba9\\u0bc8\\u0ba4\\u0bcd\\u0ba4\\u0bc1\",\"quiz_categories\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0b9f\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"quizzes\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0bb5\\u0bbf\\u0b9f\\u0bc8\",\"subjects\":\"\\u0baa\\u0bbe\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"topics\":\"\\u0ba4\\u0bb2\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"questions\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"home\":\"\\u0bae\\u0bc1\\u0b95\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"faqs\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf \\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\",\"about_us\":\"\\u0b8e\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bc8 \\u0baa\\u0bb1\\u0bcd\\u0bb1\\u0bbf\",\"contact_us\":\"\\u0b8e\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bc8 \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\\u0baa\\u0bc1\",\"email\":\"\\u0bae\\u0bbf\\u0ba9\\u0bcd\\u0ba9\\u0b9e\\u0bcd\\u0b9a\\u0bb2\\u0bcd\",\"password\":\"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\",\"login\":\"\\u0b89\\u0bb3\\u0bcd \\u0ba8\\u0bc1\\u0bb4\\u0bc8\",\"forgot_password\":\"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd \\u0bae\\u0bb1\\u0ba8\\u0bcd\\u0ba4\\u0bc1 \\u0bb5\\u0bbf\\u0b9f\\u0bcd\\u0b9f\\u0bc0\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bbe\",\"register\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc1\",\"this_field_id_required\":\"\\u0b87\\u0ba8\\u0bcd\\u0ba4 \\u0ba4\\u0bc1\\u0bb1\\u0bc8\\u0baf\\u0bbf\\u0bb2\\u0bcd \\u0b90\\u0b9f\\u0bbf \\u0ba4\\u0bc7\\u0bb5\\u0bc8\",\"please_enter_valid_email\":\"\\u0b9a\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0ba9 \\u0bae\\u0bbf\\u0ba9\\u0bcd\\u0ba9\\u0b9e\\u0bcd\\u0b9a\\u0bb2\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"this_field_is_required\":\"\\u0b87\\u0ba8\\u0bcd\\u0ba4 \\u0ba4\\u0bc1\\u0bb1\\u0bc8\\u0baf\\u0bbf\\u0bb2\\u0bcd \\u0ba4\\u0bc7\\u0bb5\\u0bc8\",\"the_text_is_too_short\":\"\\u0b89\\u0bb0\\u0bc8 \\u0bae\\u0bbf\\u0b95\\u0bb5\\u0bc1\\u0bae\\u0bcd \\u0b9a\\u0bbf\\u0bb1\\u0bbf\\u0baf\\u0ba4\\u0bbe\\u0b95 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0ba4\\u0bc1\",\"settings\":\"\",\"are_you_sure\":\"\\u0ba8\\u0bc0 \\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\\u0bb5\\u0ba4\\u0bc1 \\u0b89\\u0bb1\\u0bc1\\u0ba4\\u0bbf\\u0baf\\u0bbe\",\"you_will_not_be_able_to_recover_this_record\":\"\\u0b87\\u0ba8\\u0bcd\\u0ba4\\u0baa\\u0bcd \\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bbf\\u0bb2\\u0bcd \\u0bae\\u0bc0\\u0b9f\\u0bcd\\u0b95 \\u0bae\\u0bc1\\u0b9f\\u0bbf\\u0baf\\u0bbe\\u0ba4\\u0bc1\",\"yes\":\"\\u0b86\\u0bae\\u0bcd\",\"delete_it\":\"\\u0ba8\\u0bc0\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"no\":\"\\u0b87\\u0bb2\\u0bcd\\u0bb2\\u0bc8\",\"cancel_please\":\"\\u0bb0\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0b95\",\"your_record_has_been_deleted\":\"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc1 \\u0ba8\\u0bc0\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1\",\"cancelled\":\"\\u0bb0\\u0ba4\\u0bcd\\u0ba4\\u0bc1\",\"your_record_is_safe\":\"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0b9a\\u0bbe\\u0ba4\\u0ba9\\u0bc8\\u0baf\\u0bc8 \\u0baa\\u0bbe\\u0ba4\\u0bc1\\u0b95\\u0bbe\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0ba9\\u0ba4\\u0bc1\",\"exam_series\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\",\"instructions\":\"\\u0bb5\\u0bb4\\u0bbf\\u0bae\\u0bc1\\u0bb1\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"coupons\":\"\\u0b95\\u0bc2\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"list\":\"\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0bbf\\u0baf\\u0bb2\\u0bcd\",\"add\":\"\\u0b95\\u0bc2\\u0b9f\\u0bcd\\u0b9f\\u0bc1\",\"contents\":\"\\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0bb3\\u0b9f\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd\",\"series\":\"\\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\",\"payment_reports\":\"\\u0b95\\u0bc6\\u0bbe\\u0b9f\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bb5\\u0bc1 \\u0b85\\u0bb1\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"online_payments\":\"\\u0b86\\u0ba9\\u0bcd\\u0bb2\\u0bc8\\u0ba9\\u0bcd \\u0b95\\u0bc6\\u0bbe\\u0b9f\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bb5\\u0bc1\",\"offline_payments\":\"\\u0ba8\\u0ba9\\u0bcd\\u0bb1\\u0bbf \\u0b9a\\u0bc6\\u0bb2\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\\u0bae\\u0bcd\",\"export\":\"\\u0b8f\\u0bb1\\u0bcd\\u0bb1\\u0bc1\\u0bae\\u0ba4\\u0bbf\",\"notifications\":\"\\u0b85\\u0bb1\\u0bbf\\u0bb5\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"sms\":\"\\u0b8e\\u0bb8\\u0bcd\\u0b8e\\u0bae\\u0bcd\\u0b8e\\u0bb8\\u0bcd\",\"feedback\":\"\\u0b95\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\",\"update_strings\":\"\\u0b9a\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bc8 \\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1\",\"create_series\":\"\\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bc8 \\u0b89\\u0bb0\\u0bc1\\u0bb5\\u0bbe\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"title\":\"\\u0ba4\\u0bb2\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"duration\":\"\\u0b95\\u0bbe\\u0bb2\\u0bae\\u0bcd\",\"category\":\"\\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"is_paid\":\"\\u0b9a\\u0bc6\\u0bb2\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bc1\\u0b95\\u0bbf\\u0bb1\\u0ba4\\u0bc1\",\"total_marks\":\"\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0bae\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc6\\u0ba3\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"update_questions\":\"\\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1 \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"free\":\"\\u0b87\\u0bb2\\u0bb5\\u0b9a\",\"paid\":\"\\u0baa\\u0ba3\\u0bae\\u0bcd\",\"create_quiz\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0b9f\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe \\u0b89\\u0bb0\\u0bc1\\u0bb5\\u0bbe\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"quiz_title\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0b9f\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe \\u0ba4\\u0bb2\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"invalid_input\":\"\\u0ba4\\u0bb5\\u0bb1\\u0bbe\\u0ba9 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bc0\\u0b9f\\u0bc1\",\"the_text_is_too_long\":\"\\u0b89\\u0bb0\\u0bc8 \\u0bae\\u0bbf\\u0b95\\u0bb5\\u0bc1\\u0bae\\u0bcd \\u0ba8\\u0bc0\\u0bb3\\u0bae\\u0bbe\\u0b95 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0ba4\\u0bc1\",\"enter_value_in_minutes\":\"\\u0bae\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc1 \\u0ba8\\u0bbf\\u0bae\\u0bbf\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"please_enter_valid_number\":\"\\u0ba4\\u0baf\\u0bb5\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0ba4\\u0bc1 \\u0b9a\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0ba9 \\u0b8e\\u0ba3\\u0bcd\\u0ba3\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"it will be updated by adding the questions\":\"\\u0b85\\u0ba4\\u0bc1 \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd \\u0b9a\\u0bc7\\u0bb0\\u0bcd\\u0baa\\u0bcd\\u0baa\\u0ba4\\u0ba9\\u0bcd \\u0bae\\u0bc2\\u0bb2\\u0bae\\u0bcd \\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bc1\\u0bae\\u0bcd\",\"pass_percentage\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0b9a\\u0bcd\\u0b9a\\u0bbf \\u0b9a\\u0ba4\\u0bb5\\u0bc0\\u0ba4\\u0bae\\u0bcd\",\"negative_mark\":\"\\u0b8e\\u0ba4\\u0bbf\\u0bb0\\u0bcd\\u0bae\\u0bb1\\u0bc8 \\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\",\"instructions_page\":\"\\u0bb5\\u0bb4\\u0bbf\\u0bae\\u0bc1\\u0bb1\\u0bc8\\u0b95\\u0bb3\\u0bcd \\u0baa\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd\",\"start_date\":\"\\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0b95\\u0bcd\\u0b95 \\u0ba4\\u0bc7\\u0ba4\\u0bbf\",\"end_date\":\"\\u0b95\\u0b9f\\u0bc8\\u0b9a\\u0bbf \\u0ba4\\u0bc7\\u0ba4\\u0bbf\",\"select\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1\",\"validity\":\"\\u0b8f\\u0bb1\\u0bcd\\u0bb1\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc6\\u0bbe\\u0bb3\\u0bcd\\u0bb3\\u0b95\\u0bcd\\u0b95\\u0bc2\\u0b9f\\u0bbf\\u0baf\",\"validity_in_days\":\"\\u0ba8\\u0bbe\\u0b9f\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0b8f\\u0bb1\\u0bcd\\u0bb1\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc6\\u0bbe\\u0bb3\\u0bcd\\u0bb3\\u0b95\\u0bcd \\u0b95\\u0bc2\\u0b9f\\u0bbf\\u0baf\",\"cost\":\"\\u0b9a\\u0bc6\\u0bb2\\u0bb5\\u0bc1\",\"description\":\"\\u0bb5\\u0bbf\\u0bb3\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd\",\"update_questions_for\":\"\\u0bae\\u0bc7\\u0bae\\u0bcd\\u0baa\\u0b9f\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bb2\\u0bcd \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"difficulty\":\"\\u0b95\\u0b9f\\u0bbf\\u0ba9\\u0bae\\u0bcd\",\"easy\":\"\\u0b8e\\u0bb3\\u0bbf\\u0ba4\\u0bbe\\u0b95\",\"medium\":\"\\u0ba8\\u0b9f\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bb0\",\"hard\":\"\\u0bb9\\u0bbe\\u0bb0\\u0bcd\\u0b9f\\u0bcd\",\"question_type\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf \\u0bb5\\u0b95\\u0bc8\",\"single_answer\":\"\\u0b92\\u0bb1\\u0bcd\\u0bb1\\u0bc8 \\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\",\"multi_answer\":\"\\u0bae\\u0bb2\\u0bcd\\u0b9f\\u0bbf \\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\",\"fill_in_the_blanks\":\"\\u0bb5\\u0bc6\\u0bb1\\u0bcd\\u0bb1\\u0bbf\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bc8 \\u0ba8\\u0bbf\\u0bb0\\u0baa\\u0bcd\\u0baa\",\"match_the_following\":\"\\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\\u0ba8\\u0bcd\\u0ba4\\u0bc1 \\u0bb5\\u0ba8\\u0bcd\\u0ba4 \\u0baa\\u0bc7\\u0bbe\\u0b9f\\u0bcd\\u0b9f\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"paragraph\":\"\\u0baa\\u0ba4\\u0bcd\\u0ba4\\u0bbf\",\"video\":\"\\u0b95\\u0bbe\\u0ba3\\u0bc6\\u0bbe\\u0bb3\\u0bbf\",\"search_term\":\"\\u0ba4\\u0bc7\\u0b9f\\u0bb2\\u0bcd \\u0b95\\u0bbe\\u0bb2\",\"enter_search_term\":\"\\u0ba4\\u0bc7\\u0b9f\\u0bb2\\u0bcd \\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\\u0bb2\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"subject\":\"\\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0bb3\\u0bcd\",\"question\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\",\"type\":\"\\u0bb5\\u0b95\\u0bc8\",\"marks\":\"\\u0bae\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc6\\u0ba3\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"saved_questions\":\"\\u0b9a\\u0bc7\\u0bae\\u0bbf\\u0ba4\\u0bcd\\u0ba4 \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"remove_all\":\"\\u0b85\\u0ba9\\u0bc8\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0ba8\\u0bc0\\u0b95\\u0bcd\\u0b95\",\"update\":\"\\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1\",\"import_excel\":\"\\u0b87\\u0bb1\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bae\\u0ba4\\u0bbf \\u0b8e\\u0b95\\u0bcd\\u0b9a\\u0bc6\\u0bb2\\u0bcd\",\"add_user\":\"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd \\u0b9a\\u0bc7\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0b95\",\"name\":\"\\u0baa\\u0bc6\\u0baf\\u0bb0\\u0bcd\",\"image\":\"\\u0baa\\u0b9f\",\"role\":\"\\u0baa\\u0b99\\u0bcd\\u0b95\\u0bc1\",\"import_users\":\"\\u0b87\\u0bb1\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bae\\u0ba4\\u0bbf \\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"download_template\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bbf\\u0bb1\\u0b95\\u0bcd\\u0b95 \\u0b9f\\u0bc6\\u0bae\\u0bcd\\u0baa\\u0bcd\\u0bb3\\u0bc7\\u0b9f\\u0bcd\",\"upload\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc7\\u0bb1\\u0bcd\\u0bb1\\u0bc1\",\"upload_excel\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc7\\u0bb1\\u0bcd\\u0bb1\\u0bae\\u0bcd \\u0b8e\\u0b95\\u0bcd\\u0b9a\\u0bc6\\u0bb2\\u0bcd\",\"file_type_not_allowed\":\"\\u0b95\\u0bc7\\u0bbe\\u0baa\\u0bcd\\u0baa\\u0bc1 \\u0bb5\\u0b95\\u0bc8 \\u0b85\\u0ba9\\u0bc1\\u0bae\\u0ba4\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bb5\\u0bbf\\u0bb2\\u0bcd\\u0bb2\\u0bc8\",\"subjects_list\":\"\\u0baa\\u0bbe\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bbf\\u0bb2\\u0bcd \\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0bbf\\u0baf\\u0bb2\\u0bcd\",\"import\":\"\\u0b87\\u0bb1\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bae\\u0ba4\\u0bbf\",\"id\":\"\\u0b85\\u0b9f\\u0bc8\\u0baf\\u0bbe\\u0bb3\\u0bae\\u0bcd\",\"max_marks\":\"\\u0bae\\u0bc7\\u0b95\\u0bcd\\u0bb8\\u0bcd \\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0bb8\\u0bcd\",\"pass_marks\":\"\\u0baa\\u0bbe\\u0bb8\\u0bcd \\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0bb8\\u0bcd\",\"total_exams\":\"\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"total_questions\":\"\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"update_quizzes\":\"\\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1 \\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0bb5\\u0bbf\\u0b9f\\u0bc8\",\"update_series_for\":\"\\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1 \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\",\"exam_categories\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"exam_name\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0baa\\u0bc6\\u0baf\\u0bb0\\u0bcd\",\"saved_exams\":\"\\u0b9a\\u0bc7\\u0bae\\u0bbf\\u0ba4\\u0bcd\\u0ba4 \\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"no_data_available\":\"\\u0ba4\\u0bb0\\u0bb5\\u0bc1 \\u0b8e\\u0ba4\\u0bc1\\u0bb5\\u0bc1\\u0bae\\u0bcd \\u0b95\\u0bbf\\u0b9f\\u0bc8\\u0b95\\u0bcd\\u0b95\\u0bb5\\u0bbf\\u0bb2\\u0bcd\\u0bb2\\u0bc8\",\"couponcodes\":\"Couponcodes\",\"discount\":\"\\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf\",\"minimum_bill\":\"\\u0b95\\u0bc1\\u0bb1\\u0bc8\\u0ba8\\u0bcd\\u0ba4\\u0baa\\u0b9f\\u0bcd\\u0b9a \\u0baa\\u0bbf\\u0bb2\\u0bcd\",\"maximum_discount\":\"\\u0b85\\u0ba4\\u0bbf\\u0b95\\u0baa\\u0b9f\\u0bcd\\u0b9a \\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf\",\"limit\":\"\\u0b85\\u0bb3\\u0bb5\\u0bc1\",\"status\":\"\\u0ba8\\u0bbf\\u0bb2\\u0bc8\\u0bae\\u0bc8\",\"question_subjects\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf \\u0baa\\u0bbe\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"import_questions\":\"\\u0b87\\u0bb1\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bae\\u0ba4\\u0bbf \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"add_subject\":\"\\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0bb3\\u0bcd \\u0b9a\\u0bc7\\u0bb0\\u0bcd\",\"view_questions\":\"\\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0b95\\u0bb3\\u0bc8\\u0b95\\u0bcd \\u0b95\\u0bbe\\u0ba3\\u0bcd\\u0b95\",\"examseries\":\"Examseries\",\"edit_coupon\":\"\\u0b95\\u0bc2\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bcd \\u0ba4\\u0bbf\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\",\"coupon_code\":\"\\u0b95\\u0bc2\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bcd \\u0b95\\u0bc1\\u0bb1\\u0bbf\\u0baf\\u0bc0\\u0b9f\\u0bc1\",\"value\":\"\\u0bae\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"percent\":\"\\u0b9a\\u0ba4\\u0bb5\\u0bc0\\u0ba4\\u0bae\\u0bcd\",\"discount_type\":\"\\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf \\u0bb5\\u0b95\\u0bc8\",\"discount_value\":\"\\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf \\u0bae\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"enter_value\":\"\\u0bae\\u0ba4\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"discount_maximum_amount\":\"\\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf \\u0b85\\u0ba4\\u0bbf\\u0b95\\u0baa\\u0b9f\\u0bcd\\u0b9a \\u0b85\\u0bb3\\u0bb5\\u0bc1\",\"enter_maximum_amount\":\"\\u0b85\\u0ba4\\u0bbf\\u0b95\\u0baa\\u0b9f\\u0bcd\\u0b9a \\u0b85\\u0bb3\\u0bb5\\u0bc1 \\u0b9a\\u0bc7\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0b95\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"valid_from\":\"\\u0b9a\\u0bc6\\u0bb2\\u0bcd\\u0bb2\\u0bc1\\u0baa\\u0b9f\\u0bbf\\u0baf\\u0bbe\\u0b95\\u0bc1\\u0bae\\u0bcd\",\"valid_to\":\"\\u0b9a\\u0bc6\\u0bb2\\u0bcd\\u0bb2\\u0bc1\\u0baa\\u0b9f\\u0bbf\\u0baf\\u0bbe\\u0b95\\u0bc1\\u0bae\\u0bcd\",\"usage_limit\":\"\\u0baa\\u0baf\\u0ba9\\u0bcd\\u0baa\\u0bbe\\u0b9f\\u0bc1 \\u0b95\\u0bc1\\u0bb1\\u0bc8\\u0b95\\u0bcd\\u0b95\",\"enter_usage_limit_per_user\":\"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd \\u0b92\\u0ba9\\u0bcd\\u0bb1\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc1 \\u0baa\\u0baf\\u0ba9\\u0bcd\\u0baa\\u0bbe\\u0b9f\\u0bc1 \\u0b95\\u0bc1\\u0bb1\\u0bc8\\u0b95\\u0bcd\\u0b95 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"pending\":\"\\u0ba8\\u0bbf\\u0bb2\\u0bc1\\u0bb5\\u0bc8\\u0baf\\u0bbf\\u0bb2\\u0bcd\",\"total\":\"\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4\",\"overall_statistics\":\"\\u0b92\\u0b9f\\u0bcd\\u0b9f\\u0bc1\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0baa\\u0bc1\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0bb5\\u0bbf\\u0baa\\u0bb0\\u0bae\\u0bcd\",\"payments_reports_in\":\"\\u0baa\\u0ba3\\u0bae\\u0bcd \\u0b85\\u0bb1\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"payments\":\"\\u0b95\\u0bc6\\u0bbe\\u0b9f\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bb5\\u0bc1\",\"payment_statistics\":\"\\u0b95\\u0bc6\\u0bbe\\u0b9f\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bb5\\u0bc1 \\u0baa\\u0bc1\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0baf\\u0bbf\\u0baf\\u0bb2\\u0bcd\",\"payment_monthly_statistics\":\"\\u0bae\\u0bbe\\u0ba4\\u0bbe\\u0ba8\\u0bcd\\u0ba4\\u0bbf\\u0bb0 \\u0baa\\u0bc1\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0bb5\\u0bbf\\u0baa\\u0bb0\\u0bae\\u0bcd\",\"feed_backs\":\"\\u0b8a\\u0b9f\\u0bcd\\u0b9f\\u0bae\\u0bcd \\u0bae\\u0bc1\\u0ba4\\u0bc1\\u0b95\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc1\",\"posted_on\":\"posted On\",\"view\":\"\\u0b95\\u0bbe\\u0ba3\\u0bcd\\u0b95\",\"feedback_details\":\"\\u0b95\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0bb5\\u0bbf\\u0baa\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"feedbacks\":\"\\u0baa\\u0bbf\\u0ba9\\u0bcd\\u0ba9\\u0bc2\\u0b9f\\u0bcd\\u0b9f\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bc8\",\"back\":\"\\u0bae\\u0bc0\\u0ba3\\u0bcd\\u0b9f\\u0bc1\\u0bae\\u0bcd\",\"module\":\"\\u0ba4\\u0bc6\\u0bbe\\u0b95\\u0bc1\\u0ba4\\u0bbf\",\"key\":\"\\u0bae\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bbf\\u0baf\",\"demanding_quizzes\":\"\\u0b95\\u0bc7\\u0bbe\\u0bb0\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0bb5\\u0bbf\\u0b9f\\u0bc8\",\"demanding\":\"\\u0b95\\u0bc7\\u0bbe\\u0bb0\\u0bbf\",\"quizzes_usage\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0bb5\\u0bbf\\u0b9f\\u0bc8 \\u0baa\\u0baf\\u0ba9\\u0bcd\\u0baa\\u0bbe\\u0b9f\\u0bc1\",\"paid_quizzes_usage\":\"\\u0baa\\u0ba3\\u0bae\\u0bcd \\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0bb5\\u0bbf\\u0b9f\\u0bc8 \\u0baa\\u0baf\\u0ba9\\u0bcd\\u0baa\\u0bbe\\u0b9f\\u0bc1\",\"your_payment_was cancelled\":\"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0baa\\u0ba3\\u0bae\\u0bcd \\u0bb0\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0baf\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1\",\"subscriptions_list\":\"\\u0b9a\\u0ba8\\u0bcd\\u0ba4\\u0bbe\\u0b95\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0bbf\\u0baf\\u0bb2\\u0bcd\",\"plan_type\":\"\\u0ba4\\u0bbf\\u0b9f\\u0bcd\\u0b9f\\u0bae\\u0bcd \\u0bb5\\u0b95\\u0bc8\",\"paid_from\":\"\\u0b87\\u0bb0\\u0bc1\\u0ba8\\u0bcd\\u0ba4\\u0bc1 \\u0baa\\u0ba3\\u0bae\\u0bcd\",\"datetime\":\"\\u0ba4\\u0bc7\\u0ba4\\u0bbf \\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd\",\"my_bookmarks\":\"\\u0b8e\\u0ba9\\u0ba4\\u0bc1 \\u0baa\\u0bc1\\u0b95\\u0bcd\\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"analysis\":\"\\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0baf\\u0bcd\\u0bb5\\u0bc1\",\"by_subjcet\":\"Subjcet \\u0bae\\u0bc2\\u0bb2\\u0bae\\u0bcd\",\"by_exam\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0bae\\u0bc2\\u0bb2\\u0bae\\u0bcd\",\"history\":\"\\u0bb5\\u0bb0\\u0bb2\\u0bbe\\u0bb1\\u0bc1\",\"subscriptions\":\"\\u0b9a\\u0ba8\\u0bcd\\u0ba4\\u0bbe\\u0b95\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"add_setting\":\"\\u0b85\\u0bae\\u0bc8\\u0ba4\\u0bcd\\u0ba4\\u0bb2\\u0bcd \\u0b9a\\u0bc7\\u0bb0\\u0bcd\",\"introduction\":\"\\u0b85\\u0bb1\\u0bbf\\u0bae\\u0bc1\\u0b95\\u0bae\\u0bcd\",\"description_of_the_topic\":\"\\u0ba4\\u0bb2\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0ba9\\u0bcd \\u0bb5\\u0bbf\\u0bb3\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd\",\"old_password\":\"\\u0baa\\u0bb4\\u0bc8\\u0baf \\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\",\"the_password_is_too_short\":\"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd \\u0bae\\u0bbf\\u0b95\\u0bb5\\u0bc1\\u0bae\\u0bcd \\u0b9a\\u0bbf\\u0bb1\\u0bbf\\u0baf\\u0ba4\\u0bbe\\u0b95 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0ba4\\u0bc1\",\"new_password\":\"\\u0baa\\u0bc1\\u0ba4\\u0bbf\\u0baf \\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\",\"retype_password\":\"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd\\u0bb2\\u0bc8 \\u0bae\\u0bc0\\u0ba3\\u0bcd\\u0b9f\\u0bc1\\u0bae\\u0bcd \\u0ba4\\u0b9f\\u0bcd\\u0b9f\\u0b9a\\u0bcd\\u0b9a\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0b95\",\"password_and_confirm_password_does_not_match\":\"\\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd \\u0b89\\u0bb1\\u0bc1\\u0ba4\\u0bbf \\u0b95\\u0b9f\\u0bb5\\u0bc1\\u0b9a\\u0bcd\\u0b9a\\u0bc6\\u0bbe\\u0bb2\\u0bcd \\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0ba8\\u0bcd\\u0ba4\\u0bb5\\u0bbf\\u0bb2\\u0bcd\\u0bb2\\u0bc8\",\"correct\":\"\\u0b9a\\u0bb0\\u0bbf\",\"wrong\":\"\\u0ba4\\u0bb5\\u0bb1\\u0bbe\\u0ba9\",\"not_answered\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bb3\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0bb5\\u0bbf\\u0bb2\\u0bcd\\u0bb2\\u0bc8\",\"overall_performance\":\"\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4\\u0ba4\\u0bcd\\u0ba4\\u0bbf\\u0bb2\\u0bcd \\u0b9a\\u0bc6\\u0baf\\u0bb2\\u0bcd\\u0ba4\\u0bbf\\u0bb1\\u0ba9\\u0bcd\",\"performance\":\"\\u0b9a\\u0bc6\\u0baf\\u0bb2\\u0bcd\\u0ba4\\u0bbf\\u0bb1\\u0ba9\\u0bcd\",\"best_performance_in_all_quizzes\":\"\\u0b85\\u0ba9\\u0bc8\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0bb5\\u0bbf\\u0b9f\\u0bc8 \\u0b9a\\u0bbf\\u0bb1\\u0ba8\\u0bcd\\u0ba4 \\u0ba8\\u0b9f\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"view_analysis\":\"\\u0b95\\u0bbe\\u0ba3\\u0bcd\\u0b95 \\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0baf\\u0bcd\\u0bb5\\u0bc1\",\"edit_user\":\"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd \\u0ba4\\u0bbf\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\",\"username\":\"\\u0baa\\u0baf\\u0ba9\\u0bb0\\u0bcd\\u0baa\\u0bc6\\u0baf\\u0bb0\\u0bcd\",\"select_role\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0baa\\u0b99\\u0bcd\\u0b95\\u0bc1\",\"phone\":\"\\u0ba4\\u0bc6\\u0bbe\\u0bb2\\u0bc8\\u0baa\\u0bc7\\u0b9a\\u0bbf\",\"please_enter_10-15_digit_mobile_number\":\"\\u0ba4\\u0baf\\u0bb5\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0ba4\\u0bc1 10-15 \\u0b87\\u0bb2\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd \\u0bae\\u0bc6\\u0bbe\\u0baa\\u0bc8\\u0bb2\\u0bcd \\u0b8e\\u0ba3\\u0bcd\\u0ba3\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"please_enter_valid_phone_number\":\"\\u0ba4\\u0baf\\u0bb5\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0ba4\\u0bc1 \\u0b9a\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0ba9 \\u0ba4\\u0bc6\\u0bbe\\u0bb2\\u0bc8\\u0baa\\u0bc7\\u0b9a\\u0bbf \\u0b8e\\u0ba3\\u0bcd\\u0ba3\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"address\":\"\\u0bae\\u0bc1\\u0b95\\u0bb5\\u0bb0\\u0bbf\",\"please_enter_your_address\":\"\\u0ba4\\u0baf\\u0bb5\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0ba4\\u0bc1 \\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bc1\\u0b95\\u0bb5\\u0bb0\\u0bbf\\u0baf\\u0bc8 \\u0b89\\u0bb3\\u0bcd\\u0bb3\\u0bbf\\u0b9f\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"give_feedback\":\"\\u0b95\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0ba4\\u0bc6\\u0bb0\\u0bbf\\u0bb5\\u0bbf\",\"feedback_form\":\"\\u0b95\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0baa\\u0b9f\\u0bbf\\u0bb5\\u0bae\\u0bcd\",\"send\":\"\\u0b85\\u0ba9\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bc1\",\"account_settings\":\"\\u0b95\\u0ba3\\u0b95\\u0bcd\\u0b95\\u0bc1 \\u0b85\\u0bae\\u0bc8\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"quiz_and_exam_series\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0b9f\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe \\u0bae\\u0bb1\\u0bcd\\u0bb1\\u0bc1\\u0bae\\u0bcd \\u0baa\\u0bb0\\u0bc0\\u0b9f\\u0bcd\\u0b9a\\u0bc8 \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\",\"lms_categories\":\"LMS \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"time_spent_on_correct_answers\":\"\\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd \\u0b9a\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0ba9 \\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\\u0b95\\u0bb3\\u0bc8 \\u0b9a\\u0bc6\\u0bb2\\u0bb5\\u0bc1\",\"time_spent_on_wrong_answers\":\"\\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd \\u0ba4\\u0bb5\\u0bb1\\u0bbe\\u0ba9 \\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\\u0b95\\u0bb3\\u0bc8 \\u0b9a\\u0bc6\\u0bb2\\u0bb5\\u0bc1\",\"overall_marks_analysis\":\"\\u0b92\\u0b9f\\u0bcd\\u0b9f\\u0bc1\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0bb8\\u0bcd \\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0baf\\u0bcd\\u0bb5\\u0bc1\",\"overall_subject_wise_analysis\":\"\\u0b92\\u0b9f\\u0bcd\\u0b9f\\u0bc1\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0baa\\u0bc6\\u0bbe\\u0bb0\\u0bc1\\u0bb3\\u0bcd \\u0bb5\\u0bbe\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0b95 \\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0baf\\u0bcd\\u0bb5\\u0bc1\",\"of\":\"\\u0b8e\\u0ba9\\u0bcd\\u0bb1\",\"spent_on_correct\":\"\\u0b9a\\u0bb0\\u0bbf\\u0baf\\u0bbe\\u0ba9 \\u0b9a\\u0bc6\\u0bb2\\u0bb5\\u0bc1\",\"spent_on_wrong\":\"\\u0ba4\\u0bb5\\u0bb1\\u0bbe\\u0ba9 \\u0b9a\\u0bc6\\u0bb2\\u0bb5\\u0bc1\",\"total_time\":\"\\u0bae\\u0bc6\\u0bbe\\u0ba4\\u0bcd\\u0ba4 \\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd\",\"spent_time\":\"\\u0b95\\u0bb4\\u0bbf\\u0ba4\\u0bcd\\u0ba4 \\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd\",\"all_exams\":\"\\u0b85\\u0ba9\\u0bc8\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"dueration\":\"Dueration\",\"take_exam\":\"\\u0baa\\u0bb0\\u0bc0\\u0b9f\\u0bcd\\u0b9a\\u0bc8 \\u0b8e\\u0b9f\\u0bc1\\u0b95\\u0bcd\\u0b95\",\"mins\":\"mins\",\"please_read_the_instructions_carefully\":\"\\u0b95\\u0bb5\\u0ba9\\u0bae\\u0bbe\\u0b95 \\u0b85\\u0bb1\\u0bbf\\u0bb5\\u0bc1\\u0bb0\\u0bc8\\u0b95\\u0bb3\\u0bc8 \\u0baa\\u0b9f\\u0bbf\\u0ba4\\u0bcd\\u0ba4\\u0bc1 \\u0b95\\u0bc6\\u0bbe\\u0bb3\\u0bcd\\u0bb3\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"general_instructions\":\"\\u0baa\\u0bc6\\u0bbe\\u0ba4\\u0bc1 \\u0bb5\\u0bb4\\u0bbf\\u0bae\\u0bc1\\u0bb1\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"buy_now\":\"\\u0b87\\u0baa\\u0bcd\\u0baa\\u0bc7\\u0bbe\\u0ba4\\u0bc1 \\u0bb5\\u0bbe\\u0b99\\u0bcd\\u0b95\",\"checkout\":\"\\u0bb5\\u0bc6\\u0bb3\\u0bbf\\u0baf\\u0bc7\\u0bb1\\u0bc1\\u0ba4\\u0bb2\\u0bcd\",\"valid_for\":\"\\u0b9a\\u0bc6\\u0bb2\\u0bcd\\u0bb2\\u0bc1\\u0baa\\u0b9f\\u0bbf\\u0baf\\u0bbe\\u0b95\\u0bc1\\u0bae\\u0bcd\",\"days\":\"\\u0ba8\\u0bbe\\u0b9f\\u0bcd\\u0b95\\u0bb3\\u0bbf\\u0bb2\\u0bcd\",\"enter_coupon_code\":\"\\u0b95\\u0bc2\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bcd \\u0b95\\u0bc1\\u0bb1\\u0bbf\\u0baf\\u0bc0\\u0b9f\\u0bc1 \\u0ba8\\u0bc1\\u0bb4\\u0bc8\\u0baf\",\"apply\":\"\\u0bb5\\u0bbf\\u0ba3\\u0bcd\\u0ba3\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95\",\"payu\":\"Payu\",\"paypal\":\"\\u0baa\\u0bc7\\u0baa\\u0bbe\\u0bb2\\u0bcd\",\"click_here_to_update_payment_details\":\"\\u0b95\\u0bc6\\u0bbe\\u0b9f\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0ba9\\u0bb5\\u0bc1 \\u0bb5\\u0bbf\\u0bb5\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0baa\\u0bc1\\u0ba4\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b95\\u0bcd\\u0b95 \\u0b87\\u0b99\\u0bcd\\u0b95\\u0bc1 \\u0b95\\u0bbf\\u0bb3\\u0bbf\\u0b95\\u0bcd\",\"offline_payment\":\"\\u0ba8\\u0ba9\\u0bcd\\u0bb1\\u0bbf \\u0b9a\\u0bc6\\u0bb2\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\\u0ba4\\u0bb2\\u0bcd\",\"details\":\"\\u0bb5\\u0bbf\\u0bb5\\u0bb0\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"billing_address\":\"\\u0baa\\u0bbf\\u0bb2\\u0bcd\\u0bb2\\u0bbf\\u0b99\\u0bcd \\u0bae\\u0bc1\\u0b95\\u0bb5\\u0bb0\\u0bbf\",\"limit_reached\":\"\\u0bb5\\u0bb0\\u0bc8\\u0baf\\u0bb1\\u0bc8\\u0baf\\u0bc8 \\u0b8e\\u0b9f\\u0bcd\\u0b9f\\u0bbf\\u0baf\\u0bc1\\u0bb3\\u0bcd\\u0bb3\\u0ba4\\u0bc1\",\"hey_you_are_eligible_for_discount\":\"\\u0bb9\\u0bc7 \\u0baf\\u0bc2 \\u0ba4\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0baa\\u0b9f\\u0bbf \\u0ba4\\u0b95\\u0bc1\\u0ba4\\u0bbf\\u0baf\\u0bc1\\u0b9f\\u0bc8\\u0baf\\u0bb5\\u0bb0\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0b86\\u0bb5\\u0bb0\\u0bcd\",\"your_subscription_was_successfull\":\"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0b9a\\u0ba8\\u0bcd\\u0ba4\\u0bbe\\u0bb5\\u0bc8 \\u0bb5\\u0bc6\\u0bb1\\u0bcd\\u0bb1\\u0bbf\\u0b95\\u0bb0\\u0bae\\u0bbe\\u0b95\",\"please_accept_terms_and_conditions\":\"\\u0bb5\\u0bbf\\u0ba4\\u0bbf\\u0bae\\u0bc1\\u0bb1\\u0bc8\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bb1\\u0bcd\\u0bb1\\u0bc1\\u0bae\\u0bcd \\u0ba8\\u0bbf\\u0baa\\u0ba8\\u0bcd\\u0ba4\\u0ba9\\u0bc8\\u0b95\\u0bb3\\u0bcd \\u0ba4\\u0baf\\u0bb5\\u0bc1 \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0ba4\\u0bc1 \\u0b8f\\u0bb1\\u0bcd\\u0bb1\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc6\\u0bbe\\u0bb3\\u0bcd\\u0bb3\\u0bc1\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"start_exam\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0b99\\u0bcd\\u0b95\",\"previous\":\"\\u0bae\\u0bc1\\u0ba8\\u0bcd\\u0ba4\\u0bc8\\u0baf\",\"next\":\"\\u0b85\\u0b9f\\u0bc1\\u0ba4\\u0bcd\\u0ba4\",\"clear_answer\":\"\\u0ba4\\u0bc6\\u0bb3\\u0bbf\\u0bb5\\u0bbe\\u0ba9 \\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\",\"bookmarks\":\"\\u0baa\\u0bc1\\u0b95\\u0bcd\\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0bb8\\u0bcd\",\"exam_duration\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0b95\\u0bbe\\u0bb2\\u0bae\\u0bcd\",\"hints\":\"\\u0b95\\u0bc1\\u0bb1\\u0bbf\\u0baa\\u0bcd\\u0baa\\u0bc1\\u0b95\\u0bb3\\u0bcd\",\"bookmark_this_question\":\"\\u0b87\\u0ba8\\u0bcd\\u0ba4\\u0b95\\u0bcd \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0baf\\u0bc8\\u0b95\\u0bcd \\u0baa\\u0bc1\\u0b95\\u0bcd\\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd\",\"unbookmark_this_question\":\"Unbookmark \\u0b87\\u0ba8\\u0bcd\\u0ba4\\u0b95\\u0bcd \\u0b95\\u0bc7\\u0bb3\\u0bcd\\u0bb5\\u0bbf\\u0baf\\u0bc8\\u0b95\\u0bcd\",\"mark_for_review\":\"\\u0bae\\u0bbe\\u0bb0\\u0bcd\\u0b95\\u0bcd, \\u0bb5\\u0bbf\\u0bae\\u0bb0\\u0bcd\\u0b9a\\u0ba9\\u0bae\\u0bcd\",\"finish\":\"\\u0baa\\u0bbf\\u0ba9\\u0bbf\\u0bb7\\u0bcd\",\"summary\":\"\\u0b9a\\u0bc1\\u0bb0\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd\",\"answered\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\",\"marked\":\"\\u0b95\\u0bc1\\u0bb1\\u0bbf\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1\",\"not_visited\":\"\\u0bb5\\u0bbf\\u0b9c\\u0baf\\u0bae\\u0bcd\",\"consumed_time\":\"\\u0b89\\u0b9f\\u0bcd\\u0b95\\u0bc6\\u0bbe\\u0bb3\\u0bcd\\u0bb3\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bc1\\u0b95\\u0bbf\\u0bb1\\u0ba4\\u0bc1 \\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd\",\"result_for\":\"\\u0bae\\u0bc1\\u0b9f\\u0bbf\\u0bb5\\u0bc1\",\"score\":\"\\u0bb8\\u0bcd\\u0b95\\u0bc7\\u0bbe\\u0bb0\\u0bcd\",\"percentage\":\"\\u0b9a\\u0ba4\\u0bb5\\u0bbf\\u0ba4\\u0bae\\u0bcd\",\"grade\":\"\\u0ba4\\u0bb0\\u0bae\\u0bcd\",\"view_key\":\"\\u0b95\\u0bbe\\u0ba3\\u0bcd\\u0b95 \\u0bae\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bbf\\u0baf\",\"toppers_in_this_exam\":\"\\u0b87\\u0ba8\\u0bcd\\u0ba4 \\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bbf\\u0bb2\\u0bcd \\u0bae\\u0bc1\\u0ba4\\u0bb2\\u0bbf\\u0b9f\\u0ba4\\u0bcd\\u0ba4\\u0bbf\\u0bb2\\u0bcd\",\"click on toper to compare your score\":\"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bb8\\u0bcd\\u0b95\\u0bc7\\u0bbe\\u0bb0\\u0bcd \\u0b92\\u0baa\\u0bcd\\u0baa\\u0bbf\\u0b9f\\u0bcd\\u0b9f\\u0bc1 Toper \\u0b95\\u0bbf\\u0bb3\\u0bbf\\u0b95\\u0bcd \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0baf\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"answers\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb2\\u0bcd\\u0b95\\u0bb3\\u0bcd\",\"result\":\"\\u0bb5\\u0bbf\\u0bb3\\u0bc8\\u0bb5\\u0bbe\\u0b95\",\"time_limit\":\"\\u0ba8\\u0bc7\\u0bb0 \\u0bb5\\u0bb0\\u0bae\\u0bcd\\u0baa\\u0bbf\\u0bb1\\u0bcd\\u0b95\\u0bc1\",\"time_taken\":\"\\u0b8e\\u0b9f\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\\u0b95\\u0bcd\\u0b95\\u0bc6\\u0bbe\\u0ba3\\u0bcd\\u0b9f \\u0ba8\\u0bc7\\u0bb0\\u0bae\\u0bcd\",\"explanation\":\"\\u0bb5\\u0bbf\\u0bb3\\u0b95\\u0bcd\\u0b95\\u0bae\\u0bcd\",\"exam_analysis\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0baf\\u0bcd\\u0bb5\\u0bc1\",\"attempts\":\"\\u0bae\\u0bc1\\u0baf\\u0bb1\\u0bcd\\u0b9a\\u0bbf\\u0b95\\u0bb3\\u0bcd\",\"analysis_by_exam\":\"\\u0ba4\\u0bc7\\u0bb0\\u0bcd\\u0bb5\\u0bc1 \\u0bae\\u0bc2\\u0bb2\\u0bae\\u0bcd \\u0baa\\u0b95\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0bbe\\u0baf\\u0bcd\\u0bb5\\u0bc1\",\"children\":\"\\u0b95\\u0bc1\\u0bb4\\u0ba8\\u0bcd\\u0ba4\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"no_categories_available\":\"\\u0b95\\u0bbf\\u0b9f\\u0bc8\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bae\\u0bcd \\u0b87\\u0bb2\\u0bcd\\u0bb2\\u0bc8 \\u0bb5\\u0b95\\u0bc8\\u0b95\\u0bb3\\u0bcd\",\"click_here_to_change_your_preferences\":\"\\u0b89\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bb5\\u0bbf\\u0bb0\\u0bc1\\u0baa\\u0bcd\\u0baa\\u0b99\\u0bcd\\u0b95\\u0bb3\\u0bcd \\u0bae\\u0bbe\\u0bb1\\u0bcd\\u0bb1 \\u0b87\\u0b99\\u0bcd\\u0b95\\u0bc7 \\u0b95\\u0bbf\\u0bb3\\u0bbf\\u0b95\\u0bcd \\u0b9a\\u0bc6\\u0baf\\u0bcd\\u0baf\\u0bb5\\u0bc1\\u0bae\\u0bcd\",\"record_added_successfully\":\"\\u0baa\\u0ba4\\u0bbf\\u0bb5\\u0bc1 \\u0b9a\\u0bc7\\u0bb0\\u0bcd\\u0b95\\u0bcd\\u0b95\\u0baa\\u0bcd\\u0baa\\u0b9f\\u0bcd\\u0b9f\\u0ba4\\u0bc1 \\u0bb5\\u0bc6\\u0bb1\\u0bcd\\u0bb1\\u0bbf\\u0b95\\u0bb0\\u0bae\\u0bbe\\u0b95\",\"lms_series\":\"LMS \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\",\"no_series_available\":\"\\u0b95\\u0bbf\\u0b9f\\u0bc8\\u0b95\\u0bcd\\u0b95\\u0bc1\\u0bae\\u0bcd \\u0b8e\\u0ba8\\u0bcd\\u0ba4 \\u0ba4\\u0bc6\\u0bbe\\u0b9f\\u0bb0\\u0bcd\",\"edit_quiz\":\"\\u0bb5\\u0bbf\\u0ba9\\u0bbe\\u0b9f\\u0bbf \\u0bb5\\u0bbf\\u0ba9\\u0bbe \\u0ba4\\u0bbf\\u0bb0\\u0bc1\\u0ba4\\u0bcd\\u0ba4\\u0bc1\"}', '2016-08-23 00:09:43', '2018-04-02 02:53:10'),
(7, 'Urdu', 'urdu', 'ur', 1, 0, '{\"success\":\"\\u06a9\\u0627\\u0645\\u06cc\\u0627\\u0628\\u06cc\",\"record_updated_successfully\":\"\\u0631\\u06cc\\u06a9\\u0627\\u0631\\u0688 \\u06a9\\u0627\\u0645\\u06cc\\u0627\\u0628\\u06cc \\u0633\\u06d2 \\u0627\\u067e \\u0688\\u06cc\\u0679\",\"languages\":\"\\u0632\\u0628\\u0627\\u0646\\u06cc\\u06ba\",\"create\":\"\\u0628\\u0646\\u0627\\u0646\\u0627\",\"language\":\"\\u0632\\u0628\\u0627\\u0646\",\"code\":\"\\u0636\\u0627\\u0628\\u0637\\u06d2\",\"is_rtl\":\"RTL \\u06c1\\u06d2\",\"default_language\":\"\\u0688\\u06cc\\u0641\\u0627\\u0644\\u0679 \\u0644\\u06cc\\u0646\\u06af\\u0648\\u0626\\u062c\",\"action\":\"\\u0639\\u0645\\u0644\",\"deleted\":\"\\u062d\\u0630\\u0641 \\u0634\\u062f\\u06c1\",\"sorry\":\"\\u0645\\u0639\\u0630\\u0631\\u062a\",\"cannot_delete_this_record_as\":\"\\u062d\\u0630\\u0641 \\u0646\\u06c1\\u06cc\\u06ba \\u06a9\\u0631 \\u0633\\u06a9\\u062a\\u06d2 \\u0627\\u0633 \\u0631\\u06cc\\u06a9\\u0627\\u0631\\u0688 \\u06a9\\u06d2 \\u0637\\u0648\\u0631 \\u067e\\u0631\",\"site_title\":\"\\u0648\\u06cc\\u0628 \\u0633\\u0627\\u0626\\u0679 \\u06a9\\u0627 \\u0639\\u0646\\u0648\\u0627\\u0646\",\"latest_users\":\"\\u062a\\u0627\\u0632\\u06c1 \\u062a\\u0631\\u06cc\\u0646 \\u0635\\u0627\\u0631\\u0641\\u06cc\\u0646\",\"was_joined_as\":\"\\u062c\\u06cc\\u0633\\u0627 \\u06a9\\u06c1 \\u0634\\u0627\\u0645\\u0644 \\u06a9\\u06cc\\u0627 \\u06af\\u06cc\\u0627 \\u062a\\u06be\\u0627\",\"see_more\":\"\\u062f\\u06cc\\u06a9\\u06be\\u06cc\\u06ba \\u0645\\u0632\\u06cc\\u062f\",\"my_profile\":\"\\u0645\\u06cc\\u0631\\u06cc \\u067e\\u0631\\u0648\\u0641\\u0627\\u0626\\u0644\",\"change_password\":\"\\u067e\\u0627\\u0633 \\u0648\\u0631\\u0688 \\u062a\\u0628\\u062f\\u06cc\\u0644 \\u06a9\\u0631\\u06cc\\u06ba\",\"logout\":\"\\u0644\\u0627\\u06af \\u0622\\u0648\\u0679\",\"dashboard\":\"\\u0688\\u06cc\\u0634 \\u0628\\u0648\\u0631\\u0688\",\"users\":\"\\u0635\\u0627\\u0631\\u0641\\u06cc\\u0646\",\"roles\":\"\\u06a9\\u0631\\u062f\\u0627\\u0631\",\"fee_settings\":\"\\u0641\\u06cc\\u0633 \\u062a\\u0631\\u062a\\u06cc\\u0628\\u0627\\u062a\",\"fee_categories\":\"\\u0641\\u06cc\\u0633 \\u062c\\u0627\\u062a\",\"fee_category_allotment\":\"\\u0641\\u06cc\\u0633 \\u0632\\u0645\\u0631\\u06c1 \\u062a\\u06cc\\u0646 \\u06c1\\u0644\\u0627\\u06a9\",\"fee_particulars\":\"\\u0641\\u06cc\\u0633 \\u062a\\u0641\\u0635\\u06cc\\u0644\\u0627\\u062a\",\"fee_schedules\":\"\\u0641\\u06cc\\u0633 \\u0634\\u06cc\\u0688\\u0648\\u0644\",\"fines\":\"\\u062c\\u0631\\u0645\\u0627\\u0646\\u06c1\",\"discounts\":\"\\u0688\\u0633\\u06a9\\u0627\\u0624\\u0646\\u0679\\u0633\",\"master_settings\":\"\\u0645\\u0627\\u0633\\u0679\\u0631 \\u062a\\u0631\\u062a\\u06cc\\u0628\\u0627\\u062a\",\"religions_master\":\"\\u0645\\u0630\\u0627\\u06c1\\u0628 \\u0645\\u0627\\u0633\\u0679\\u0631\",\"academics_master\":\"\\u0645\\u0627\\u06c1\\u0631\\u06cc\\u0646 \\u062a\\u0639\\u0644\\u06cc\\u0645 \\u0645\\u0627\\u0633\\u0679\\u0631\",\"courses_master\":\"\\u06a9\\u0648\\u0631\\u0633\\u0632 \\u0645\\u0627\\u0633\\u0679\\u0631\",\"subjects_master\":\"\\u0645\\u0636\\u0627\\u0645\\u06cc\\u0646 \\u0645\\u06cc\\u06ba \\u0645\\u0627\\u0633\\u0679\\u0631\",\"subject_topics\":\"\\u0645\\u0648\\u0636\\u0648\\u0639 \\u06a9\\u06d2 \\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a\",\"course_subjects\":\"\\u06a9\\u0648\\u0631\\u0633 \\u0645\\u0636\\u0627\\u0645\\u06cc\\u0646\",\"email_templates\":\"\\u0627\\u06cc \\u0645\\u06cc\\u0644 \\u0633\\u0627\\u0646\\u0686\\u06d2\",\"exams\":\"\\u0627\\u0645\\u062a\\u062d\\u0627\\u0646\\u0627\\u062a\",\"categories\":\"\\u0627\\u0642\\u0633\\u0627\\u0645\",\"question_bank\":\"\\u0633\\u0648\\u0627\\u0644 \\u0628\\u06cc\\u0646\\u06a9\",\"quiz\":\"\\u06a9\\u0648\\u0626\\u0632\",\"lms\":\"LMS\",\"content\":\"\\u0645\\u0648\\u0627\\u062f\",\"study_materials\":\"\\u0645\\u0637\\u0627\\u0644\\u0639\\u06c1 \\u0645\\u0648\\u0627\\u062f\",\"library\":\"\\u0644\\u0627\\u0626\\u0628\\u0631\\u06cc\\u0631\\u06cc\",\"asset_types\":\"\\u0627\\u062b\\u0627\\u062b\\u06c1 \\u06a9\\u06cc \\u0627\\u0642\\u0633\\u0627 \\u0645\",\"master_data\":\"\\u0645\\u0627\\u0633\\u0679\\u0631 \\u0688\\u06cc\\u0679\\u0627\",\"publishers\":\"\\u0646\\u0627\\u0634\\u0631\\u06cc\\u0646\",\"authors\":\"\\u0645\\u0635\\u0646\\u0641\\u06cc\\u0646\",\"students\":\"\\u0637\\u0644\\u0628\\u0627\\u0621\",\"staff\":\"\\u0627\\u0633\\u0679\\u0627\\u0641\",\"school_hub\":\"\\u0633\\u06a9\\u0648\\u0644 \\u062d\\u0628\",\"attendance\":\"\\u062d\\u0627\\u0636\\u0631\\u06cc\",\"edit\":\"\\u062a\\u0635\\u06cc\\u062d\",\"delete\":\"\\u062d\\u0630\\u0641 \\u06a9\\u0631\\u06cc\\u06ba\",\"enable\":\"\\u0641\\u0639\\u0627\\u0644\",\"set_default\":\"\\u067e\\u06c1\\u0644\\u06d2 \\u0633\\u06d2 \\u0637\\u06d2 \\u0634\\u062f\\u06c1\",\"disable\":\"\\u063a\\u06cc\\u0631 \\u0641\\u0639\\u0627\\u0644 \\u06a9\\u0631\\u06cc\\u06ba\",\"user_statistics\":\"\\u06cc\\u0648\\u0632\\u0631 \\u06a9\\u06d2 \\u0627\\u0639\\u062f\\u0627\\u062f\\u0648\\u0634\\u0645\\u0627\\u0631\",\"view_all\":\"\\u0633\\u0628 \\u062f\\u06cc\\u06a9\\u06be\\u06cc\\u06ba\",\"quiz_categories\":\"\\u06a9\\u0648\\u0626\\u0632 \\u062c\\u0627\\u062a\",\"quizzes\":\"QUIZZES\",\"subjects\":\"\\u0645\\u0636\\u0627\\u0645\\u06cc\\u0646\",\"topics\":\"\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a\",\"questions\":\"\\u0633\\u0648\\u0627\\u0644\\u0627\\u062a\"}', '2016-08-23 04:38:33', '2018-04-02 02:53:10');
INSERT INTO `languages` (`id`, `language`, `slug`, `code`, `is_rtl`, `is_default`, `phrases`, `created_at`, `updated_at`) VALUES
(9, 'English', 'english-1', 'en', 0, 1, '{\"success\":\"Success\",\"record_updated_successfully\":\"Record Updated Successfully\",\"languages\":\"Languages\",\"create\":\"Create\",\"language\":\"Language\",\"code\":\"Code\",\"is_rtl\":\"Is Rtl\",\"default_language\":\"Default Language\",\"action\":\"Action\",\"deleted\":\"Deleted\",\"sorry\":\"Sorry\",\"cannot_delete_this_record_as\":\"Cannot Delete This Record As\",\"site_title\":\"Site Title\",\"latest_users\":\"Latest Users\",\"was_joined_as\":\"Was Joined As\",\"see_more\":\"See More\",\"my_profile\":\"My Profile\",\"change_password\":\"Change Password\",\"logout\":\"Logout\",\"dashboard\":\"Dashboard\",\"users\":\"Users\",\"exams\":\"Exams\",\"categories\":\"Categories\",\"question_bank\":\"Question Bank\",\"quiz\":\"Quiz\",\"master_settings\":\"Master Settings\",\"subjects_master\":\"Subjects Master\",\"subject_topics\":\"Subject Topics\",\"email_templates\":\"Email Templates\",\"settings\":\"Settings\",\"edit\":\"Edit\",\"delete\":\"Delete\",\"enable\":\"Enable\",\"set_default\":\"Set Default\",\"disable\":\"Disable\",\"add_user\":\"Add User\",\"name\":\"Name\",\"email\":\"Email\",\"image\":\"Image\",\"role\":\"Role\",\"edit_user\":\"Edit User\",\"list\":\"List\",\"update\":\"Update\",\"this_field_is_required\":\"This Field Is Required\",\"the_text_is_too_short\":\"The Text Is Too Short\",\"the_text_is_too_long\":\"The Text Is Too Long\",\"invalid_input\":\"Invalid Input\",\"please_enter_valid_email\":\"Please Enter Valid Email\",\"select_role\":\"Select Role\",\"add_language\":\"Add Language\",\"language_title\":\"Language Title\",\"language_code\":\"Language Code\",\"supported_language_codes\":\"Supported Language Codes\",\"no\":\"No\",\"yes\":\"Yes\",\"edit_language\":\"Edit Language\",\"add_users\":\"Add Users\",\"quiz_categories\":\"Quiz Categories\",\"category\":\"Category\",\"description\":\"Description\",\"create_category\":\"Create Category\",\"category_name\":\"Category Name\",\"please_upload_valid_image_type\":\"Please Upload Valid Image Type\",\"edit_author\":\"Edit Author\",\"question_subjects\":\"Question Subjects\",\"add_subject\":\"Add Subject\",\"subject\":\"Subject\",\"view_questions\":\"View Questions\",\"add\":\"Add\",\"subjects\":\"Subjects\",\"subject_title\":\"Subject Title\",\"subject_code\":\"Subject Code\",\"is_lab\":\"Is Lab\",\"is_elective\":\"Is Elective\",\"maximum_marks\":\"Maximum Marks\",\"please_enter_valid_number\":\"Please Enter Valid Number\",\"pass_marks\":\"Pass Marks\",\"please_enter_valid_maximum_marks\":\"Please Enter Valid Maximum Marks\",\"please_enter_valid_pass_marks\":\"Please Enter Valid Pass Marks\",\"pass_marks_cannot_be_greater_than_maximum_marks\":\"Pass Marks Cannot Be Greater Than Maximum Marks\",\"password\":\"Password\",\"login\":\"Login\",\"forgot_password\":\"Forgot Password\",\"register\":\"Register\",\"questions\":\"Questions\",\"topic\":\"Topic\",\"type\":\"Type\",\"question\":\"Question\",\"marks\":\"Marks\",\"difficulty\":\"Difficulty\",\"subjects_list\":\"Subjects List\",\"max_marks\":\"Max Marks\",\"topics_list\":\"Topics List\",\"parent\":\"Parent\",\"title\":\"Title\",\"from_email\":\"From Email\",\"from_name\":\"From Name\",\"quizzes\":\"Quizzes\",\"dueration\":\"Dueration\",\"is_paid\":\"Is Paid\",\"total_marks\":\"Total Marks\",\"update_questions\":\"Update Questions\",\"free\":\"Free\",\"paid\":\"Paid\",\"module\":\"Module\",\"key\":\"Key\",\"view\":\"View\",\"add_setting\":\"Add Setting\",\"edit_topic\":\"Edit Topic\",\"topics\":\"Topics\",\"select_parent\":\"Select Parent\",\"topic_name\":\"Topic Name\",\"edit_template\":\"Edit Template\",\"welcome\":\"Welcome\",\"content\":\"Content\",\"email_content\":\"Email Content\",\"create_template\":\"Create Template\",\"select\":\"Select\",\"add_topic\":\"Add Topic\",\"user_statistics\":\"User Statistics\",\"view_all\":\"View All\",\"edit_subject\":\"Edit Subject\",\"user_registration\":\"User Registration\",\"password_confirmation\":\"Password Confirmation\",\"password_and_confirm_password_does_not_match\":\"Password And Confirm Password Does Not Match\",\"i_am_a_student\":\"I Am A Student\",\"i_am_a_parent\":\"I Am A Parent\",\"register_now\":\"Register Now\",\"i_am_having_account\":\"I Am Having Account\",\"children\":\"Children\",\"edit_profile\":\"Edit Profile\",\"buy_package\":\"Buy Package\",\"all_exams\":\"All Exams\",\"recent_activity\":\"Recent Activity\",\"mins\":\"Mins\",\"old_password\":\"Old Password\",\"new_password\":\"New Password\",\"retype_password\":\"Retype Password\",\"exam_already_submitted\":\"Exam Already Submitted\",\"history\":\"History\",\"analysis\":\"Analysis\",\"by_subjcet\":\"By Subjcet\",\"by_exam\":\"By Exam\",\"subscriptions\":\"Subscriptions\",\"plans\":\"Plans\",\"invoices\":\"Invoices\",\"exam_analysis\":\"Exam Analysis\",\"attempts\":\"Attempts\",\"analysis_by_exam\":\"Analysis By Exam\",\"of\":\"Of\",\"exam_attempt\":\"Exam Attempt\",\"marks_obtained\":\"Marks Obtained\",\"exam_aborted\":\"Exam Aborted\",\"take_exam\":\"Take Exam\",\"exam_name\":\"Exam Name\",\"explanation\":\"Explanation\",\"previous\":\"Previous\",\"mark_for_review\":\"Mark For Review\",\"next\":\"Next\",\"clear_answer\":\"Clear Answer\",\"finish\":\"Finish\",\"total_time\":\"Total Time\",\"summary\":\"Summary\",\"answered\":\"Answered\",\"marked\":\"Marked\",\"not_answered\":\"Not Answered\",\"not_visited\":\"Not Visited\",\"subscription_plans\":\"Subscription Plans\",\"it_is_a\":\"It Is A\",\"ooops__!\":\"Ooops..!\",\"you_have_no_permission_to_access\":\"You Have No Permission To Access\",\"correct\":\"Correct\",\"wrong\":\"Wrong\",\"overall_performance\":\"Overall Performance\",\"performance\":\"Performance\",\"best_performance_in_all_quizzes\":\"Best Performance In All Quizzes\",\"view_analysis\":\"View Analysis\",\"you_already_subscribed_to_use_this_system___\":\"You Already Subscribed To Use This System...\",\"sno\":\"Sno\",\"date\":\"Date\",\"total\":\"Total\",\"download\":\"Download\",\"overall_subject_wise_analysis\":\"Overall Subject Wise Analysis\",\"update_questions_for\":\"Update Questions For\",\"page_not_found\":\"Page Not Found\",\"ooops___!\":\"Ooops...!\",\"inter_mathematicss__have_no_topics,_please_add_topics_to_upload_questions\":\"Inter Mathematicss  Have No Topics, Please Add Topics To Upload Questions\",\"upload_question\":\"Upload Question\",\"question_file\":\"Question File\",\"difficulty_level\":\"Difficulty Level\",\"hint\":\"Hint\",\"question_type\":\"Question Type\",\"total_options\":\"Total Options\",\"answer_number\":\"Answer Number\",\"total_correct_answers\":\"Total Correct Answers\",\"total_blank_answers\":\"Total Blank Answers\",\"left_title\":\"Left Title\",\"right_title\":\"Right Title\",\"left_option\":\"Left Option\",\"total_questions\":\"Total Questions\",\"create_quiz\":\"Create Quiz\",\"quiz_title\":\"Quiz Title\",\"enter_value_in_minutes\":\"Enter Value In Minutes\",\"it_will_be_updated_by_adding_the_questions\":\"It Will Be Updated By Adding The Questions\",\"pass_percentage\":\"Pass Percentage\",\"edit_quiz\":\"Edit Quiz\",\"currently_you_have_not_subscribed_to_any_plan\":\"Currently You Have Not Subscribed To Any Plan\",\"subscription_was_successfull\":\"Subscription Was Successfull\",\"congrats_you_account_is_successfully_subscribed_with\":\"Congrats You Account Is Successfully Subscribed With\",\"plan_with_transaction_no\":\"Plan With Transaction No\",\"record_added_successfully\":\"Record Added Successfully\",\"user_details\":\"User Details\",\"details_of\":\"Details Of\",\"reports\":\"Reports\",\"exam_history\":\"Exam History\",\"view_details\":\"View Details\",\"by_subject\":\"By Subject\",\"exam_attempts_and_score\":\"Exam Attempts And Score\",\"quiz_attempts\":\"Quiz Attempts\",\"percentage\":\"Percentage\",\"grade\":\"Grade\",\"result\":\"Result\",\"attempted_on\":\"Attempted On\",\"edit_question\":\"Edit Question\",\"password_updated_successfully\":\"Password Updated Successfully\",\"result_for\":\"Result For\",\"score\":\"Score\",\"toppers_in_this_exam\":\"Toppers In This Exam\",\"the_password_is_too_short\":\"The Password Is Too Short\",\"explanation_file\":\"Explanation File\",\"negative_mark\":\"Negative Mark\",\"time_to_spend\":\"Time To Spend\",\"in_seconds\":\"In Seconds\",\"having_negative_mark\":\"Having Negative Mark\",\"asset_belongs_to_subject\":\"Asset Belongs To Subject\",\"is_having_url\":\"Is Having Url\",\"question_file_is_url\":\"Question File Is Url\",\"instructions\":\"Instructions\",\"add_instructions\":\"Add Instructions\",\"edit_instruction\":\"Edit Instruction\",\"instructions_page\":\"Instructions Page\",\"record_deleted_successfully\":\"Record Deleted Successfully\",\"category_deleted_successfully\":\"Category Deleted Successfully\",\"setting_key\":\"Setting Key\",\"value\":\"Value\",\"setting_value\":\"Setting Value\",\"edit_settings\":\"Edit Settings\",\"subject_wise_analysis\":\"Subject Wise Analysis\",\"in\":\"In\",\"exam\":\"Exam\",\"my_bookmarks\":\"My Bookmarks\",\"record_bookmarked\":\"Record Bookmarked\",\"bookmark_already_available\":\"Bookmark Already Available\",\"bookmark_removed\":\"Bookmark Removed\",\"added_to_bookmarks\":\"Added To Bookmarks\",\"unbookmark_this_question\":\"Unbookmark This Question\",\"bookmark_this_question\":\"Bookmark This Question\",\"remove_from_bookmarks\":\"Remove From Bookmarks\",\"cost\":\"Cost\",\"validity\":\"Validity\",\"total_exams\":\"Total Exams\",\"create_series\":\"Create Series\",\"exam_series\":\"Exam Series\",\"series_title\":\"Series Title\",\"validity_in_days\":\"Validity In Days\",\"it_will_be_updated_by_adding_the_exams\":\"It Will Be Updated By Adding The Exams\",\"short_description\":\"Short Description\",\"add_exam_series\":\"Add Exam Series\",\"update_quizzes\":\"Update Quizzes\",\"edit_series\":\"Edit Series\",\"under_construction\":\"Under Construction\",\"exam_categories\":\"Exam Categories\",\"update_series_for\":\"Update Series For\",\"saved_exams\":\"Saved Exams\",\"no_data_available\":\"No Data Available\",\"remove_all\":\"Remove All\",\"add_series\":\"Add Series\",\"no_settings_available\":\"No Settings Available\",\"oops\":\"Oops\",\"invalid_record\":\"Invalid Record\",\"details\":\"Details\",\"advantages_of_this_package\":\"Advantages Of This Package\",\"it_includes\":\"It Includes\",\"overview\":\"Overview\",\"days\":\"Days\",\"pay_now\":\"Pay Now\",\"valid_for\":\"Valid For\",\"apply\":\"Apply\",\"enter_coupon_code\":\"Enter Coupon Code\",\"paypal\":\"Paypal\",\"payu\":\"Payu\",\"your_subscription_was_successfull\":\"Your Subscription Was Successfull\",\"subscriptions_list\":\"Subscriptions List\",\"plan_type\":\"Plan Type\",\"start_date\":\"Start Date\",\"end_date\":\"End Date\",\"paid_through\":\"Paid Through\",\"coupon_applied\":\"Coupon Applied\",\"your_payment_was_cancelled\":\"Your Payment Was Cancelled\",\"status\":\"Status\",\"paid_from\":\"Paid From\",\"datetime\":\"Datetime\",\"phone\":\"Phone\",\"please_enter_valid_phone_number\":\"Please Enter Valid Phone Number\",\"address\":\"Address\",\"billing_address\":\"Billing Address\",\"couponcodes\":\"Couponcodes\",\"coupons\":\"Coupons\",\"usage\":\"Usage\",\"discount\":\"Discount\",\"minimum_bill\":\"Minimum Bill\",\"maximum_discount\":\"Maximum Discount\",\"limit\":\"Limit\",\"create_coupon\":\"Create Coupon\",\"coupon_code\":\"Coupon Code\",\"percent\":\"Percent\",\"discount_type\":\"Discount Type\",\"discount_value\":\"Discount Value\",\"discount_maximum_amoumt\":\"Discount Maximum Amoumt\",\"valid_from\":\"Valid From\",\"valid_to\":\"Valid To\",\"attendance_date\":\"Attendance Date\",\"usage_limit\":\"Usage Limit\",\"edit_coupon\":\"Edit Coupon\",\"checkout\":\"Checkout\",\"minimum_bill_not_reached__this_is_valid_for_minimum_purchase_of_$_100_00\":\"Minimum Bill Not Reached. This Is Valid For Minimum Purchase Of $ 100.00\",\"invalid_coupon\":\"Invalid Coupon\",\"hey_you_are_eligible_for_discount\":\"Hey You Are Eligible For Discount\",\"limit_reached\":\"Limit Reached\",\"hey\":\"Hey\",\"you_already_purchased_this_item\":\"You Already Purchased This Item\",\"hey_peter\":\"Hey Peter\",\"buy_now\":\"Buy Now\",\"start_series\":\"Start Series\",\"lms_categories\":\"Lms Categories\",\"lms_content\":\"Lms Content\",\"author\":\"Author\",\"masters\":\"Masters\",\"select_category\":\"Select Category\",\"content_type\":\"Content Type\",\"is_series\":\"Is Series\",\"series\":\"Series\",\"resource_link\":\"Resource Link\",\"coupons_usage\":\"Coupons Usage\",\"lms\":\"Lms\",\"study_materials\":\"Study Materials\",\"edit_category\":\"Edit Category\",\"contents\":\"Contents\",\"create_content\":\"Create Content\",\"add_content\":\"Add Content\",\"enter_search_term\":\"Enter Search Term\",\"search_term\":\"Search Term\",\"select_subject\":\"Select Subject\",\"file_path\":\"File Path\",\"lms_file\":\"Lms File\",\"updated_at\":\"Updated At\",\"lms_contents\":\"Lms Contents\",\"lms_series\":\"Lms Series\",\"total_items\":\"Total Items\",\"add_lms_series\":\"Add Lms Series\",\"lms_category\":\"Lms Category\",\"notifications\":\"Notifications\",\"url\":\"Url\",\"add_notification\":\"Add Notification\",\"edit_notification\":\"Edit Notification\",\"posted_on\":\"Posted On\",\"file_type\":\"File Type\",\"today\":\"Today\",\"read_more\":\"Read More\",\"items\":\"Items\",\"view_more\":\"View More\",\"learning_management_series\":\"Learning Management Series\",\"premium\":\"Premium\",\"import_excel\":\"Import Excel\",\"import_users\":\"Import Users\",\"upload\":\"Upload\",\"answers\":\"Answers\",\"attempted\":\"Attempted\",\"time_spent_on_correct_answers\":\"Time Spent On Correct Answers\",\"time_spent_on_wrong_answers\":\"Time Spent On Wrong Answers\",\"overall_marks_analysis\":\"Overall Marks Analysis\",\"spent_on_correct\":\"Spent On Correct\",\"spent_on_wrong\":\"Spent On Wrong\",\"spent_time\":\"Spent Time\",\"congrats_you_are_the_new_top_10_scorer_of_this_exam\":\"Congrats You Are The New Top 10 Scorer Of This Exam\",\"consumed_time\":\"Consumed Time\",\"total_time_in_sec\":\"Total Time In Sec\",\"view_key\":\"View Key\",\"click_on_toper_to_compare_your_score\":\"Click On Toper To Compare Your Score\",\"report\":\"Report\",\"reason\":\"Reason\",\"failed\":\"Failed\",\"download_template\":\"Download Template\",\"import_subjects\":\"Import Subjects\",\"import\":\"Import\",\"id\":\"Id\",\"record_already_exists_with_this_title\":\"Record Already Exists With This Title\",\"minimum_marks\":\"Minimum Marks\",\"import_topics\":\"Import Topics\",\"topic_id\":\"Topic Id\",\"topic_(id)\":\"Topic (id)\",\"invalid_subject_id\":\"Invalid Subject Id\",\"unknown_error_occurred\":\"Unknown Error Occurred\",\"subject_id\":\"Subject Id\",\"operating_systems__have_no_topics,_please_add_topics_to_upload_questions\":\"Operating Systems  Have No Topics, Please Add Topics To Upload Questions\",\"import_questions\":\"Import Questions\",\"single_answers\":\"Single Answers\",\"multi_answers\":\"Multi Answers\",\"fill_blanks\":\"Fill Blanks\",\"match_the_following\":\"Match The Following\",\"paragraph\":\"Paragraph\",\"this_question_is_not_type_of_\":\"This Question Is Not Type Of \",\"topic_not_available_with_subject\":\"Topic Not Available With Subject\",\"insufficient_answers\":\"Insufficient Answers\",\"invalid_difficulty_level\":\"Invalid Difficulty Level\",\"total_answers\":\"Total Answers\",\"single_answer\":\"Single Answer\",\"multi_answer\":\"Multi Answer\",\"fill_the_blanks\":\"Fill The Blanks\",\"this_question_is_not_type_of__blank\":\"This Question Is Not Type Of  Blank\",\"exam_toppers\":\"Exam Toppers\",\"your_current_rank_id_is\":\"Your Current Rank Id Is\",\"outof\":\" Outof\",\"out_of\":\" Out Of\",\"compare\":\"Compare\",\"view_answers\":\"View Answers\",\"exam_details\":\"Exam Details\",\"total_users\":\"Total Users\",\"correct_answers\":\"Correct Answers\",\"wrong_answers\":\"Wrong Answers\",\"time_taken_for_correct_answers\":\"Time Taken For Correct Answers\",\"time_spent_on_not_answers\":\"Time Spent On Not Answers\",\"your_result\":\"Your Result\",\"your_best_rank_is\":\"Your Best Rank Is\",\"feed_backs\":\"Feed Backs\",\"give_feedback\":\"Give Feedback\",\"enter_your_feedback_here\":\"Enter Your Feedback Here\",\"send\":\"Send\",\"feedback_form\":\"Feedback Form\",\"feedback_submitted_successfully\":\"Feedback Submitted Successfully\",\"feedback_details\":\"Feedback Details\",\"feedbacks\":\"Feedbacks\",\"back\":\"Back\",\"deleted_successfully\":\"Deleted Successfully\",\"feedback\":\"Feedback\",\"create_message\":\"Create Message\",\"messages\":\"Messages\",\"inbox\":\"Inbox\",\"compose\":\"Compose\",\"send_message\":\"Send Message\",\"this_question_is_not_type_of__radio\":\"This Question Is Not Type Of  Radio\",\"upload_questions\":\"Upload Questions\",\"time_spent_correct_answers\":\"Time Spent Correct Answers\",\"time_spent_wrong_answers\":\"Time Spent Wrong Answers\",\"this_question_is_not_type_of__blanks\":\"This Question Is Not Type Of  Blanks\",\"this_question_is_not_type_of__checkbox\":\"This Question Is Not Type Of  Checkbox\",\"data_structures__have_no_topics,_please_add_topics_to_upload_questions\":\"Data Structures  Have No Topics, Please Add Topics To Upload Questions\",\"information_technology__have_no_topics,_please_add_topics_to_upload_questions\":\"Information Technology  Have No Topics, Please Add Topics To Upload Questions\",\"username\":\"Username\",\"please_subscribe_to_use_this_quiz\":\"Please Subscribe To Use This Quiz\",\"option_value\":\"Option Value\",\"option_text\":\"Option Text\",\"make_default\":\"Make Default\",\"currency\":\"Currency\",\"account_type\":\"Account Type\",\"site_address\":\"Site Address\",\"site_city\":\"Site City\",\"site_logo\":\"Site Logo\",\"site_favicon\":\"Site Favicon\",\"site_state\":\"Site State\",\"site_country\":\"Site Country\",\"site_zipcode\":\"Site Zipcode\",\"site_phone\":\"Site Phone\",\"meta_description\":\"Meta Description\",\"meta_keywords\":\"Meta Keywords\",\"payment_gateway_payu\":\"Payment Gateway Payu\",\"payment_gateway_paypal\":\"Payment Gateway Paypal\",\"invalid_setting\":\"Invalid Setting\",\"merchantkey\":\"Merchantkey\",\"payu_salt\":\"Payu Salt\",\"payu_merchantkey\":\"Payu Merchantkey\",\"payu_workingkey\":\"Payu Workingkey\",\"payu_mode\":\"Payu Mode\",\"enter_value\":\"Enter Value\",\"discount_maximum_amount\":\"Discount Maximum Amount\",\"id_paid\":\"Id Paid\",\"exams_are_in_use_for_this_category\":\"Exams Are In Use For This Category\",\"no_records_available\":\"No Records Available\",\"invalid_subject\":\"Invalid Subject\",\"demo_subject__have_no_topics,_please_add_topics_to_upload_questions\":\"Demo Subject  Have No Topics, Please Add Topics To Upload Questions\",\"start_exam\":\"Start Exam\",\"please_accept_terms_and_conditions\":\"Please Accept Terms And Conditions\",\"please_read_the_instructions_carefully\":\"Please Read The Instructions Carefully\",\"general_instructions\":\"General Instructions\",\"site_coupons\":\"Site Coupons\",\"select_your_child\":\"Select Your Child\",\"already_in_use\":\"Already In Use\",\"please_add_children_to_continue_payment\":\"Please Add Children To Continue Payment\",\"topper_percentage\":\"Topper Percentage\",\"update_strings\":\"Update Strings\",\"home\":\"Home\",\"faqs\":\"Faqs\",\"about_us\":\"About Us\",\"contact_us\":\"Contact Us\",\"admin_dashboard\":\"Admin Dashboard\",\"overall_users\":\"Overall Users\",\"roles\":\"Roles\",\"fee_settings\":\"Fee Settings\",\"fee_categories\":\"Fee Categories\",\"fee_category_allotment\":\"Fee Category Allotment\",\"fee_particulars\":\"Fee Particulars\",\"fee_schedules\":\"Fee Schedules\",\"fines\":\"Fines\",\"discounts\":\"Discounts\",\"religions_master\":\"Religions Master\",\"academics_master\":\"Academics Master\",\"courses_master\":\"Courses Master\",\"course_subjects\":\"Course Subjects\",\"library\":\"Library\",\"asset_types\":\"Asset Types\",\"master_data\":\"Master Data\",\"publishers\":\"Publishers\",\"authors\":\"Authors\",\"students\":\"Students\",\"staff\":\"Staff\",\"school_hub\":\"School Hub\",\"attendance\":\"Attendance\",\"update_details\":\"Update Details\",\"tool_tip\":\"Tool Tip\",\"test\":\"Test\",\"paypaltool\":\"Paypaltool\",\"pavanvalue\":\"Pavanvalue\",\"offline_payment\":\"Offline Payment\",\"click_here_to_update_payment_details\":\"Click Here To Update Payment Details\",\"offline_payment_form\":\"Offline Payment Form\",\"offline_payment_information\":\"Offline Payment Information\",\"offline_payment_instructions\":\"Offline Payment Instructions\",\"payment_details\":\"Payment Details\",\"submit\":\"Submit\",\"your_request_was_submitted_to_admin_with_reference_5a41d36fb3a6fdc49fc1818f0e2bf6d42694dbf8\":\"Your Request Was Submitted To Admin With Reference 5a41d36fb3a6fdc49fc1818f0e2bf6d42694dbf8\",\"your_request_was_submitted_to_admin_with_reference_a0ed34accbd54955a7990a3b86de1702990c0d46\":\"Your Request Was Submitted To Admin With Reference A0ed34accbd54955a7990a3b86de1702990c0d46\",\"your_request_was_submitted_to_admin\":\"Your Request Was Submitted To Admin\",\"logged_out_successfully\":\"Logged Out Successfully\",\"view_profile\":\"View Profile\",\"user_roles\":\"User Roles\",\"permissions\":\"Permissions\",\"add_role\":\"Add Role\",\"role_name\":\"Role Name\",\"display_name\":\"Display Name\",\"list_roles\":\"List Roles\",\"religions\":\"Religions\",\"this_field_id_required\":\"This Field Id Required\",\"account_settings\":\"Account Settings\",\"no_categories_available\":\"No Categories Available\",\"click_here_to_change_your_preferences\":\"Click Here To Change Your Preferences\",\"no_series_available\":\"No Series Available\",\"module_payu\":\"Module Payu\",\"messaging\":\"Messaging\",\"push_notifications\":\"Push Notifications\",\"pusher_app_id\":\"Pusher App Id\",\"pusher_key\":\"Pusher Key\",\"pusher_secret\":\"Pusher Secret\",\"one_signal_app_id\":\"One Signal App Id\",\"one_signal_subdomain_name\":\"One Signal Subdomain Name\",\"default\":\"Default\",\"driver\":\"Driver\",\"logo\":\"Logo\",\"left_sign_image\":\"Left Sign Image\",\"right_sign_image\":\"Right Sign Image\",\"left_sign_name\":\"Left Sign Name\",\"right_sign_name\":\"Right Sign Name\",\"left_sign_designation\":\"Left Sign Designation\",\"right_sign_designation\":\"Right Sign Designation\",\"watermark_image\":\"Watermark Image\",\"bottom_middle_logo\":\"Bottom Middle Logo\",\"generate_certificate\":\"Generate Certificate\",\"certificate_generation\":\"Certificate Generation\",\"certificate\":\"Certificate\",\"certificate_for\":\"Certificate For\",\"print\":\"Print\",\"payment_statistics\":\"Payment Statistics\",\"cancelled\":\"Cancelled\",\"pending\":\"Pending\",\"payment_monthly_statistics\":\"Payment Monthly Statistics\",\"payments_reports_in\":\"Payments Reports In\",\"overall_statistics\":\"Overall Statistics\",\"demanding_quizzes\":\"Demanding Quizzes\",\"quizzes_usage\":\"Quizzes Usage\",\"demanding\":\"Demanding\",\"paid_quizzes_usage\":\"Paid Quizzes Usage\",\"overall\":\"Overall\",\"payment_reports\":\"Payment Reports\",\"online_payments\":\"Online Payments\",\"offline_payments\":\"Offline Payments\",\"payments\":\"Payments\",\"success_list\":\"Success List\",\"user_name\":\"User Name\",\"item\":\"Item\",\"plan\":\"Plan\",\"payment_gateway\":\"Payment Gateway\",\"payment_status\":\"Payment Status\",\"export\":\"Export\",\"export_payments_report\":\"Export Payments Report\",\"all_records\":\"All Records\",\"from\":\"From\",\"to\":\"To\",\"payment_type\":\"Payment Type\",\"all\":\"All\",\"online\":\"Online\",\"offline\":\"Offline\",\"download_excel\":\"Download Excel\",\"from_date\":\"From Date\",\"to_date\":\"To Date\",\"export_payment_records\":\"Export Payment Records\",\"offline_payment_details\":\"Offline Payment Details\",\"notes\":\"Notes\",\"created_at\":\"Created At\",\"approve\":\"Approve\",\"reject\":\"Reject\",\"close\":\"Close\",\"comments\":\"Comments\",\"record_was_updated_successfully\":\"Record Was Updated Successfully\",\"send_sms\":\"Send Sms\",\"sms_to\":\"Sms To\",\"parents\":\"Parents\",\"admins\":\"Admins\",\"for_category\":\"For Category\",\"selected\":\"Selected\",\"message_template\":\"Message Template\",\"messges_sent_successfully_for_25_users\":\"Messges Sent Successfully For 25 Users\",\"messges_sent_successfully_for_0_users\":\"Messges Sent Successfully For 0 Users\",\"messges_sent_successfully_for_1_users\":\"Messges Sent Successfully For 1 Users\",\"no_users_available_with_the_combination\":\"No Users Available With The Combination\",\"info\":\"Info\",\"sms\":\"Sms\",\"this_record_is_in_use_in_other_modules\":\"This Record Is In Use In Other Modules\",\"show_foreign_key_constraint\":\"Show Foreign Key Constraint\",\"duration\":\"Duration\",\"examseries\":\"Examseries\",\"minimum_bill_not_reached__this_is_valid_for_minimum_purchase_of_$_111_00\":\"Minimum Bill Not Reached. This Is Valid For Minimum Purchase Of $ 111.00\",\"hey_student\":\"Hey Student\",\"are_you_sure\":\"Are You Sure\",\"you_will_not_be_able_to_recover_this_record\":\"You Will Not Be Able To Recover This Record\",\"delete_it\":\"Delete It\",\"cancel_please\":\"Cancel Please\",\"your_record_has_been_deleted\":\"Your Record Has Been Deleted\",\"your_record_is_safe\":\"Your Record Is Safe\",\"enter_maximum_amount\":\"Enter Maximum Amount\",\"enter_usage_limit_per_user\":\"Enter Usage Limit Per User\",\"please_enter_10-15_digit_mobile_number\":\"Please Enter 10-15 Digit Mobile Number\",\"please_enter_your_address\":\"Please Enter Your Address\",\"upload_excel\":\"Upload Excel\",\"easy\":\"Easy\",\"medium\":\"Medium\",\"hard\":\"Hard\",\"fill_in_the_blanks\":\"Fill In The Blanks\",\"video\":\"Video\",\"saved_questions\":\"Saved Questions\",\"introduction\":\"Introduction\",\"description_of_the_topic\":\"Description Of The Topic\",\"after_discount\":\"After Discount\",\"hey_rajesh\":\"Hey Rajesh\",\"file_type_not_allowed\":\"File Type Not Allowed\",\"enter_category_name\":\"Enter Category Name\",\"oops___!\":\"Oops...!\",\"improper_sheet_uploaded\":\"Improper Sheet Uploaded\",\"congrats you are the new top 10 scorer of this exam\":\"Congrats You Are The New Top 10 Scorer Of This Exam\",\"click on toper to compare your score\":\"Click On Toper To Compare Your Score\",\"it will be updated by adding the exams\":\"It Will Be Updated By Adding The Exams\",\"it will be updated by adding the questions\":\"It Will Be Updated By Adding The Questions\",\"topic (id)\":\"Topic (id)\",\"ooops...!\":\"Ooops...!\",\"page not found\":\"Page Not Found\",\"exam_duration\":\"Exam Duration\",\"hints\":\"Hints\",\"quiz_and_exam_series\":\"Quiz And Exam Series\",\"time_limit\":\"Time Limit\",\"time_taken\":\"Time Taken\",\"bookmarks\":\"Bookmarks\",\"email content\":\"Email Content\",\"ooops..!\":\"Ooops..!\",\"no records available\":\"No Records Available\",\"reset_password\":\"Reset Password\",\"reset_link_sent\":\"Reset Link Sent\",\"oops..!\":\"Oops..!\",\"invalid_email\":\"Invalid Email\",\"password_reset_link_sent_to_email\":\"Password Reset Link Sent To Email\",\"cannot_change_password\":\"Cannot Change Password\",\"update_lms\":\"Update Lms\",\"enter_minimum_bill\":\"Enter Minimum Bill\",\"time\":\"Time\",\"time_is_shown_in_seconds\":\"Time Is Shown In Seconds\",\"mail_driver\":\"Mail Driver\",\"mail_host\":\"Mail Host\",\"mail_port\":\"Mail Port\",\"mail_username\":\"Mail Username\",\"mail_password\":\"Mail Password\",\"mail_encryption\":\"Mail Encryption\",\"payu_merchant_key\":\"Payu Merchant Key\",\"payu_working_key\":\"Payu Working Key\",\"payu_test_mode\":\"Payu Test Mode\",\"payu_testmode\":\"Payu Testmode\",\"one_signal_user_id\":\"One Signal User Id\",\"messaging_system_for\":\"Messaging System For\",\"facebook_login\":\"Facebook Login\",\"google_plus_login\":\"Google Plus Login\",\"record_added_successfully_with_password \":\"Record Added Successfully With Password \",\"\\\\ncannot_send_email_to_user, please_check_your_server_settings\":\"\\\\ncannot Send Email To User, Please Check Your Server Settings\",\"coupon_codes\":\"Coupon Codes\",\"supported_formats are\":\"Supported Formats Are\",\"it will be updated by adding the lms items\":\"It Will Be Updated By Adding The Lms Items\",\"saved_items\":\"Saved Items\",\"warning\":\"Warning\",\"don_not_press_back\\/refresh_button\":\"Don Not Press Back\\/refresh Button\",\"billing_details\":\"Billing Details\",\"exam_analysis_by_attempts\":\"Exam Analysis By Attempts\",\"your_payment_was cancelled\":\"Your Payment Was Cancelled\",\"do_not_refresh_this_page\":\"Do Not Refresh This Page\",\"cart_subtotal\":\"Cart Subtotal\",\"order_total\":\"Order Total\",\"hey adam\":\"Hey Adam\",\"email_address\":\"Email Address\",\"confirm_password\":\"Confirm Password\",\"password_changed_successfully\":\"Password Changed Successfully\",\"oops...!\":\"Oops...!\",\"system_timezone\":\"System Timezone\",\"phone_number_expression\":\"Phone Number Expression\",\"operations_are_disabled\":\"Operations Are Disabled\",\"crudoperations are disabled\":\"Crudoperations Are Disabled\",\"operations_are_disabled_in_demo_version\":\"Operations Are Disabled In Demo Version\",\"google_analytics\":\"Google Analytics\",\"please_wait\":\"Please Wait\",\"audio\":\"Audio\",\"negetive_mark\":\"Negetive Mark\",\"click_here_to_list_subjects\":\"Click Here To List Subjects\",\"educate\":\"Educate\",\"enlight\":\"Enlight\",\"enforce\":\"Enforce\",\"background_image\":\"Background Image\",\"currency_code\":\"Currency Code\",\"linked_in_login\":\"Linked In Login\",\"twitter_login\":\"Twitter Login\",\"update_parent\":\"Update Parent\",\"privacy-policy\":\"Privacy-policy\",\"terms-conditions\":\"Terms-conditions\",\"banner_title\":\"Banner Title\",\"banner_sub_title\":\"Banner Sub Title\",\"copyrights\":\"Copyrights\",\"facebook\":\"Facebook\",\"twitter\":\"Twitter\",\"linkedin\":\"Linkedin\",\"google\":\"Google\",\"banner_image1\":\"Banner Image1\",\"banner_image2\":\"Banner Image2\",\"banner_image3\":\"Banner Image3\",\"banner_image4\":\"Banner Image4\",\"front_image1\":\"Front Image1\",\"front_image2\":\"Front Image2\",\"front_image3\":\"Front Image3\",\"front_image4\":\"Front Image4\",\"front_image5\":\"Front Image5\",\"front_image6\":\"Front Image6\",\"you have registered successfully. please check your email address\":\"You Have Registered Successfully. Please Check Your Email Address\",\"do_not_press_back\\/refresh_button\":\"Do Not Press Back\\/refresh Button\",\"question_2nd_language\":\"Question 2nd Language\",\"explanation_2nd_language\":\"Explanation 2nd Language\",\"improper_data_in_the_question\":\"Improper Data In The Question\",\"exam_type\":\"Exam Type\",\"sub_topics\":\"Sub Topics\",\"show_in_front_end\":\"Show In Front End\",\"saved_questionsss\":\"Saved Questionsss\",\"save & next\":\"Save & Next\",\"answered & marked\":\"Answered & Marked\",\"practice_exams\":\"Practice Exams\",\"error! improper data submitted please try again\":\"Error! Improper Data Submitted Please Try Again\",\"rechaptcha_site_key\":\"Rechaptcha Site Key\",\"rechaptcha_secret_key\":\"Rechaptcha Secret Key\",\"nocaptcha_secret\":\"Nocaptcha Secret\",\"nocaptcha_sitekey\":\"Nocaptcha Sitekey\",\"error! please try again\":\"Error! Please Try Again\",\"table is already created\":\"Table Is Already Created\",\"application_updated_successfully\":\"Application Updated Successfully\",\"system_upgraded_successfully\":\"System Upgraded Successfully\",\"enable_rechaptcha\":\"Enable Rechaptcha\",\"practice_exam_must_be_non_paid_exam\":\"Practice Exam Must Be Non Paid Exam\",\"practice_exam_must_be_no_section_no_timer_exam\":\"Practice Exam Must Be No Section No Timer Exam\",\"exam_types\":\"Exam Types\",\"edit_exam_type\":\"Edit Exam Type\",\"exam_type_updated_successfully\":\"Exam Type Updated Successfully\",\"latest_quizzes\":\"Latest Quizzes\",\"latest\":\"Latest\",\"children_analysis\":\"Children Analysis\",\"hey student\":\"Hey Student\",\"razorpay\":\"Razorpay\",\"this payment has already been captured\":\"This Payment Has Already Been Captured\",\"undefined variable: other_details\":\"Undefined Variable: Other Details\",\"your_payment_done_successfully\":\"Your Payment Done Successfully\",\"minutes\":\"Minutes\",\"undefined variable: post \\/oes-staging\\/razoapay\\/success http\\/1.1\\r\\naccept:                    text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,image\\/apng,*\\/*;q=0.8\\r\\naccept-encoding:           gzip, deflate, br\\r\\naccept-language:           en-gb,en-us;q=0.9,en;q=0.8\\r\\ncache-control:             max-age=0\\r\\nconnection:                keep-alive\\r\\ncontent-length:            309\\r\\ncontent-type:              application\\/x-www-form-urlencoded\\r\\ncookie:                    _ga=ga1.1.2088483531.1519802102; remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d=eyjpdii6ilwvbgvuz3g4odjnb0nkzhhkawxzvtrnpt0ilcj2ywx1zsi6ildlb3psbfwvvgwrrfjonfgxtle1nnb5swk4yngytfbhrnc4v1hkrfe0ttv6r0zzsghmdufvwerryvpuwnjmvjcwmzfkcjljb2f1ujhsnvbncw9rttaysvpwy3rkaevwm2jhmmxjmljmeecxehliq2ljr1bfzhvztle3evduchz2ru1mbnhgmtqxn0lmmejnag9xa3arqvuzdkniuly3uuv3rjfcl3ewemqywju3awvezhzhn3jpzefztllnd1u3m2t2iiwibwfjijoin2myzda2ntm5mmfmnwq4nmq5mzqymzuwogfkmmezmmi0nmrmmzdimzi3nwjmotg1yjcwzgi3yjk0yjiynjbjmij9; _gid=ga1.1.2016409626.1521520463; _gat=1; xsrf-token=eyjpdii6ilhmr01vzwdonstpwkk2mwx2m2neove9psisinzhbhvlijoizhrkdknnnzzsvfbntzfxdnf6ywnyqwxozedmewlgngtnuvwvte11ce9bdw1kttr5cevhng1zbvhpxc96dw1cq3dgdnfuywzlm3pvq0j3mhiybme2nxv0ut09iiwibwfjijoiztk3m2nkzdhiytqymgq1zmu0yzq1zme5ndkyndnkngu0njc5yjqxodflmzuxodhjmtjmowrlmguyn2eyyzu2ncj9; laravel_session=eyjpdii6ijj1tldizurxckvkb0k5bk5uyk43cnc9psisinzhbhvlijoice1bnfhzamp2yxvvxc9in1hwdhdcwhzybg5pvgvqdfuymzlrsnb2ewrysfn3n2zhuhblmdm5uflzouratdrmquzvqxbuy2zmeklwq01dz2dpula2bg5rpt0ilcjtywmioijjotfimddknzyxyjflowuyytvjztc3njg4zdnlymvjnda2mdc4zmeyzdm5zdaxota5mdgzndqxnmqynjm4mti0in0%3d\\r\\nhost:                      localhost\\r\\norigin:                    http:\\/\\/localhost\\r\\nreferer:                   http:\\/\\/localhost\\/oes-staging\\/payments\\/paynow\\/competitive-exam-series\\r\\nupgrade-insecure-requests: 1\\r\\nuser-agent:                mozilla\\/5.0 (windows nt 10.0; win64; x64) applewebkit\\/537.36 (khtml, like gecko) chrome\\/64.0.3282.186 safari\\/537.36\\r\\n\\r\\n_token=r235te0wr7ppvz7nff0ezuono2au8zwsgcjkxvtm&_token=r235te0wr7ppvz7nff0ezuono2au8zwsgcjkxvtm&razorpay_payment_id=pay_9pdj4ypw46ewb3&item_name=competitive-exam-series&type=combo&is_coupon_applied=0&coupon_id=0&actual_cost=200.00&discount_availed=0&after_discount=200.00&parent_user=1&selected_child_id=21755\":\"Undefined Variable: Post \\/oes-staging\\/razoapay\\/success Http\\/1.1\\r\\nAccept:                    Text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,image\\/apng,*\\/*;q=0.8\\r\\nAccept-encoding:           Gzip, Deflate, Br\\r\\nAccept-language:           En-gb,en-us;q=0.9,en;q=0.8\\r\\nCache-control:             Max-age=0\\r\\nConnection:                Keep-alive\\r\\nContent-length:            309\\r\\nContent-type:              Application\\/x-www-form-urlencoded\\r\\nCookie:                     Ga=ga1.1.2088483531.1519802102; Remember Web 59ba36addc2b2f9401580f014c7f58ea4e30989d=eyjpdii6ilwvbgvuz3g4odjnb0nkzhhkawxzvtrnpt0ilcj2ywx1zsi6ildlb3psbfwvvgwrrfjonfgxtle1nnb5swk4yngytfbhrnc4v1hkrfe0ttv6r0zzsghmdufvwerryvpuwnjmvjcwmzfkcjljb2f1ujhsnvbncw9rttaysvpwy3rkaevwm2jhmmxjmljmeecxehliq2ljr1bfzhvztle3evduchz2ru1mbnhgmtqxn0lmmejnag9xa3arqvuzdkniuly3uuv3rjfcl3ewemqywju3awvezhzhn3jpzefztllnd1u3m2t2iiwibwfjijoin2myzda2ntm5mmfmnwq4nmq5mzqymzuwogfkmmezmmi0nmrmmzdimzi3nwjmotg1yjcwzgi3yjk0yjiynjbjmij9;  Gid=ga1.1.2016409626.1521520463;  Gat=1; Xsrf-token=eyjpdii6ilhmr01vzwdonstpwkk2mwx2m2neove9psisinzhbhvlijoizhrkdknnnzzsvfbntzfxdnf6ywnyqwxozedmewlgngtnuvwvte11ce9bdw1kttr5cevhng1zbvhpxc96dw1cq3dgdnfuywzlm3pvq0j3mhiybme2nxv0ut09iiwibwfjijoiztk3m2nkzdhiytqymgq1zmu0yzq1zme5ndkyndnkngu0njc5yjqxodflmzuxodhjmtjmowrlmguyn2eyyzu2ncj9; Laravel Session=eyjpdii6ijj1tldizurxckvkb0k5bk5uyk43cnc9psisinzhbhvlijoice1bnfhzamp2yxvvxc9in1hwdhdcwhzybg5pvgvqdfuymzlrsnb2ewrysfn3n2zhuhblmdm5uflzouratdrmquzvqxbuy2zmeklwq01dz2dpula2bg5rpt0ilcjtywmioijjotfimddknzyxyjflowuyytvjztc3njg4zdnlymvjnda2mdc4zmeyzdm5zdaxota5mdgzndqxnmqynjm4mti0in0%3d\\r\\nHost:                      Localhost\\r\\nOrigin:                    Http:\\/\\/localhost\\r\\nReferer:                   Http:\\/\\/localhost\\/oes-staging\\/payments\\/paynow\\/competitive-exam-series\\r\\nUpgrade-insecure-requests: 1\\r\\nUser-agent:                Mozilla\\/5.0 (windows Nt 10.0; Win64; X64) Applewebkit\\/537.36 (khtml, Like Gecko) Chrome\\/64.0.3282.186 Safari\\/537.36\\r\\n\\r\\n Token=r235te0wr7ppvz7nff0ezuono2au8zwsgcjkxvtm& Token=r235te0wr7ppvz7nff0ezuono2au8zwsgcjkxvtm&razorpay Payment Id=pay 9pdj4ypw46ewb3&item Name=competitive-exam-series&type=combo&is Coupon Applied=0&coupon Id=0&actual Cost=200.00&discount Availed=0&after Discount=200.00&parent User=1&selected Child Id=21755\",\"razorpay_apikey\":\"Razorpay Apikey\",\"razorpay_secret\":\"Razorpay Secret\",\"create_account\":\"Create Account\",\"sign_in\":\"Sign In\",\"fee_instructions\":\"Fee Instructions\",\"first_create_the_fee_particulars_(_ex:- _uniform_fee,_tution_fee)\":\"First Create The Fee Particulars ( Ex:-  Uniform Fee, Tution Fee)\",\"create_fee_category_(_ex:- 2017-2018 _computer_science_1st_year_1st_semester)\":\"Create Fee Category ( Ex:- 2017-2018  Computer Science 1st Year 1st Semester)\",\"assign_fee_particulars_to_respected_fee_category\":\"Assign Fee Particulars To Respected Fee Category\",\"note : \":\"Note : \",\"once_particulars_are_assigned_to_fee_category_you_cannot_delete_fee_category\":\"Once Particulars Are Assigned To Fee Category You Cannot Delete Fee Category\",\"create_fee_schedules_for_selected_fee_category\":\"Create Fee Schedules For Selected Fee Category\",\"if_any_payment_is_done_you_cannot_update_fee_schedules\":\"If Any Payment Is Done You Cannot Update Fee Schedules\",\"you_can_add_non_term_fee_particulars_even_payment_is_done\":\"You Can Add Non Term Fee Particulars Even Payment Is Done\",\"you_are_subscription_was_successfull\":\"You Are Subscription Was Successfull\",\"fail\":\"Fail\",\"subscribed_users\":\"Subscribed Users\",\"subscribed_on\":\"Subscribed On\",\"browse_all_categories\":\"Browse All Categories\",\"view_all_exams\":\"View All Exams\",\"practice_exams_and_exam_categories\":\"Practice Exams And Exam Categories\",\"show_in_home_page\":\"Show In Home Page\",\"home_page_series_must_be_free_type_series\":\"Home Page Series Must Be Free Type Series\",\"all_series\":\"All Series\",\"view_all_series\":\"View All Series\",\"download_file\":\"Download File\",\"view_url\":\"View Url\",\"subscribe\":\"Subscribe\",\"contact_our_experts_now\":\"Contact Our Experts Now\",\"feel_free_to_contact\":\"Feel Free To Contact\",\"our_contact_details\":\"Our Contact Details\",\"please enter your name\":\"Please Enter Your Name\",\"please enter your message\":\"Please Enter Your Message\",\"please enter your subject\":\"Please Enter Your Subject\",\"please enter your phone number\":\"Please Enter Your Phone Number\",\"please provide a valid email\":\"Please Provide A Valid Email\",\"please enter a valid email address\":\"Please Enter A Valid Email Address\",\"congratulations\":\"Congratulations\",\"our_team_will_contact_you_soon\":\"Our Team Will Contact You Soon\",\"your_message_was_sent_our_team_will_contact_you_soon\":\"Your Message Was Sent Our Team Will Contact You Soon\",\"themes\":\"Themes\",\"theme_name\":\"Theme Name\",\"make_as_default_theme\":\"Make As Default Theme\",\"theme_changed_successfully\":\"Theme Changed Successfully\",\"about-us\":\"About-us\",\"home_page_title\":\"Home Page Title\",\"home_page_link\":\"Home Page Link\",\"home_page_image\":\"Home Page Image\",\"home_page_background_image\":\"Home Page Background Image\",\"home_page_facebook_link\":\"Home Page Facebook Link\",\"home_page_twitter_link\":\"Home Page Twitter Link\",\"home_page_googleplus_link\":\"Home Page Googleplus Link\",\"need_help\":\"Need Help\",\"privacy_and_policy\":\"Privacy And Policy\",\"terms_and_conditions\":\"Terms And Conditions\",\"terms_conditions\":\"Terms Conditions\",\"privacy_policy\":\"Privacy Policy\",\"follow_us_on\":\"Follow Us On\",\"create_a_new_account\":\"Create A New Account\",\"courses\":\"Courses\",\"pattren\":\"Pattren\",\"pricing\":\"Pricing\",\"syallbus\":\"Syallbus\",\"syllabus\":\"Syllabus\",\"is_active\":\"Is Active\",\"userss\":\"Userss\",\"user\":\"User\",\"cats\":\"Cats\",\"no_exams_available\":\"No Exams Available\",\"pending_list\":\"Pending List\",\"hey parent\":\"Hey Parent\",\"buy_nowss\":\"Buy Nowss\",\"you_already_purchased_this_itemee\":\"You Already Purchased This Itemee\",\"free_exams\":\"Free Exams\",\"paid_exams\":\"Paid Exams\",\"learning_management_system\":\"Learning Management System\",\"browse_all_exams\":\"Browse All Exams\",\"ooops\":\"Ooops\",\"file_is_not_found\":\"File Is Not Found\",\"no_contents_are_available\":\"No Contents Are Available\",\"actionss\":\"Actionss\",\"all_payments\":\"All Payments\",\"cancelled_list\":\"Cancelled List\",\"offline_subscription_failed\":\"Offline Subscription Failed\",\"offline_subscription_success\":\"Offline Subscription Success\",\"offline_payment_submitted\":\"Offline Payment Submitted\",\"please_verify_the_payment_details_update_the_payment_status\":\"Please Verify The Payment Details Update The Payment Status\",\"new password is sent to your email account\":\"New Password Is Sent To Your Email Account\",\"no_practice_exams_are_available\":\"No Practice Exams Are Available\",\"no_categories_are_available\":\"No Categories Are Available\",\"sms_driver\":\"Sms Driver\",\"nexmo_key\":\"Nexmo Key\",\"nexmo_secret\":\"Nexmo Secret\",\"plivo_auth_id\":\"Plivo Auth Id\",\"plivo_auth_token\":\"Plivo Auth Token\",\"twilio_sid\":\"Twilio Sid\",\"twilio_token\":\"Twilio Token\",\"parent_details\":\"Parent Details\",\"parent_login_details\":\"Parent Login Details\",\"is_parent_account_available\":\"Is Parent Account Available\",\"search\":\"Search\",\"parent_name\":\"Parent Name\",\"parent_user_name\":\"Parent User Name\",\"parent_email\":\"Parent Email\",\"_empty_\":\"\",\"google_login_is_disabled\":\"Google Login Is Disabled\",\"this_question_is_not_type_of_ checkbox\":\"This Question Is Not Type Of  Checkbox\",\"theme_color\":\"Theme Color\"}', '2016-08-30 00:41:02', '2018-04-02 02:53:10');
INSERT INTO `languages` (`id`, `language`, `slug`, `code`, `is_rtl`, `is_default`, `phrases`, `created_at`, `updated_at`) VALUES
(10, 'Hindi', 'hindi', 'hi', 0, 0, '{\"success\":\"\\u0938\\u092b\\u0932\\u0924\\u093e\",\"record_updated_successfully\":\"\\u0930\\u093f\\u0915\\u093e\\u0930\\u094d\\u0921 \\u0938\\u092b\\u0932\\u0924\\u093e\\u092a\\u0942\\u0930\\u094d\\u0935\\u0915 \\u0905\\u092a\\u0921\\u0947\\u091f\",\"languages\":\"\\u092c\\u094b\\u0932\\u0940\",\"create\":\"\\u0938\\u0930\\u094d\\u091c\\u0928 \\u0915\\u0930\\u0928\\u093e\",\"language\":\"\\u092d\\u093e\\u0937\\u093e\",\"code\":\"\\u0915\\u094b\\u0921\",\"is_rtl\":\"Rtl \\u0939\\u0948\",\"default_language\":\"\\u092e\\u0941\\u0916\\u094d\\u092f \\u092d\\u093e\\u0937\\u093e\",\"action\":\"\\u0915\\u093e\\u0930\\u094d\\u092f\",\"are_you_sure\":\"\\u0915\\u094d\\u092f\\u093e \\u0906\\u092a\\u0915\\u094b \\u092f\\u0915\\u0940\\u0928 \\u0939\\u0948\",\"you_will_not_be_able_to_recover_this_record\":\"\\u0906\\u092a \\u0907\\u0938 \\u0930\\u093f\\u0915\\u0949\\u0930\\u094d\\u0921 \\u0920\\u0940\\u0915 \\u0915\\u0930\\u0928\\u0947 \\u092e\\u0947\\u0902 \\u0938\\u0915\\u094d\\u0937\\u092e \\u0928\\u0939\\u0940\\u0902 \\u0939\\u094b\\u0917\\u093e\",\"yes\":\"\\u0939\\u093e\\u0901\",\"delete_it\":\"\\u0907\\u0938\\u0947 \\u092e\\u093f\\u091f\\u093e\\u0913\",\"no\":\"\\u0928\\u0939\\u0940\\u0902\",\"cancel_please\":\"\\u0930\\u0926\\u094d\\u0926 \\u0915\\u0930\\u0947\\u0902\",\"deleted\":\"\\u0939\\u091f\\u093e\\u090f \\u0917\\u090f\",\"sorry\":\"\\u092e\\u093e\\u092b\\u093c \\u0915\\u0940\\u091c\\u093f\\u092f\\u0947\",\"cannot_delete_this_record_as\":\"\\u0928\\u0939\\u0940\\u0902 \\u0939\\u091f\\u093e \\u0938\\u0915\\u0924\\u0947 \\u0939\\u0948\\u0902 \\u0907\\u0938 \\u0930\\u093f\\u0915\\u0949\\u0930\\u094d\\u0921 \\u0915\\u0947 \\u0930\\u0942\\u092a \\u092e\\u0947\\u0902\",\"your_record_has_been_deleted\":\"\\u0906\\u092a\\u0915\\u093e \\u0930\\u093f\\u0915\\u0949\\u0930\\u094d\\u0921 \\u0928\\u0937\\u094d\\u091f \\u0915\\u0930 \\u0926\\u093f\\u092f\\u093e \\u0917\\u092f\\u093e \\u0939\\u0948\",\"cancelled\":\"\\u0930\\u0926\\u094d\\u0926\",\"your_record_is_safe\":\"\\u0905\\u092a\\u0928\\u0947 \\u0930\\u093f\\u0915\\u0949\\u0930\\u094d\\u0921 \\u0938\\u0941\\u0930\\u0915\\u094d\\u0937\\u093f\\u0924 \\u0939\\u0948\",\"latest_users\":\"\\u0928\\u0935\\u0940\\u0928\\u0924\\u092e \\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e\\u0913\\u0902\",\"was_joined_as\":\"\\u0915\\u0947 \\u0930\\u0942\\u092a \\u092e\\u0947\\u0902 \\u0936\\u093e\\u092e\\u093f\\u0932 \\u0939\\u094b \\u0917\\u092f\\u093e \\u0925\\u093e\",\"see_more\":\"\\u0914\\u0930 \\u0926\\u0947\\u0916\\u0947\\u0902\",\"my_profile\":\"\\u092e\\u0947\\u0930\\u0940 \\u092a\\u094d\\u0930\\u094b\\u092b\\u093e\\u0907\\u0932\",\"change_password\":\"\\u092a\\u093e\\u0938\\u0935\\u0930\\u094d\\u0921 \\u092c\\u0926\\u0932\\u0947\\u0902\",\"logout\":\"\\u0932\\u094b\\u0917 \\u0906\\u0909\\u091f\",\"dashboard\":\"\\u0921\\u0948\\u0936\\u092c\\u094b\\u0930\\u094d\\u0921\",\"users\":\"\\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e\",\"exams\":\"\\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u093e\",\"categories\":\"\\u0936\\u094d\\u0930\\u0947\\u0923\\u093f\\u092f\\u093e\\u0901\",\"question_bank\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928 \\u092c\\u0948\\u0902\\u0915\",\"quiz\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928\\u094b\\u0924\\u094d\\u0924\\u0930\\u0940\",\"exam_series\":\"\\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u093e \\u0938\\u0940\\u0930\\u0940\\u091c\",\"instructions\":\"\\u0905\\u0928\\u0941\\u0926\\u0947\\u0936\",\"subjects_master\":\"\\u0935\\u093f\\u0937\\u092f\\u094b\\u0902 \\u0915\\u0947 \\u092e\\u093e\\u0938\\u094d\\u091f\\u0930\",\"subject_topics\":\"\\u0935\\u093f\\u0937\\u092f \\u0935\\u093f\\u0937\\u092f\\u094b\\u0902\",\"coupons\":\"\\u0915\\u0942\\u092a\\u0928\",\"list\":\"\\u0938\\u0942\\u091a\\u0940\",\"add\":\"\\u091c\\u094b\\u0921\\u093c\\u0928\\u093e\",\"lms\":\"\\u090f\\u0932\\u090f\\u092e\\u090f\\u0938\",\"contents\":\"\\u0905\\u0902\\u0924\\u0930\\u094d\\u0935\\u0938\\u094d\\u0924\\u0941\",\"series\":\"\\u0936\\u0943\\u0902\\u0916\\u0932\\u093e\",\"payment_reports\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u0930\\u093f\\u092a\\u094b\\u0930\\u094d\\u091f\",\"online_payments\":\"\\u0911\\u0928\\u0932\\u093e\\u0907\\u0928 \\u092d\\u0941\\u0917\\u0924\\u093e\\u0928\",\"offline_payments\":\"\\u0911\\u092b\\u093c\\u0932\\u093e\\u0907\\u0928 \\u092d\\u0941\\u0917\\u0924\\u093e\\u0928\",\"export\":\"\\u0928\\u093f\\u0930\\u094d\\u092f\\u093e\\u0924\",\"notifications\":\"\\u0938\\u0942\\u091a\\u0928\\u093e\\u090f\\u0902\",\"messages\":\"\\u0938\\u0902\\u0926\\u0947\\u0936\",\"feedback\":\"\\u092a\\u094d\\u0930\\u0924\\u093f\\u0915\\u094d\\u0930\\u093f\\u092f\\u093e\",\"master_settings\":\"\\u092e\\u093e\\u0938\\u094d\\u091f\\u0930 \\u0938\\u0947\\u091f\\u093f\\u0902\\u0917\",\"email_templates\":\"\\u0908\\u092e\\u0947\\u0932 \\u091f\\u0947\\u092e\\u094d\\u092a\\u0932\\u0947\\u091f\\u094d\\u0938\",\"settings\":\"\\u0938\\u0947\\u091f\\u093f\\u0902\\u0917\\u094d\\u0938\",\"update_strings\":\"\\u0938\\u094d\\u091f\\u094d\\u0930\\u093f\\u0902\\u0917\\u094d\\u0938 \\u0905\\u092a\\u0921\\u0947\\u091f\",\"edit\":\"\\u0938\\u0902\\u092a\\u093e\\u0926\\u093f\\u0924 \\u0915\\u0930\\u0947\\u0902\",\"delete\":\"\\u092e\\u093f\\u091f\\u093e\\u0928\\u093e\",\"enable\":\"\\u0938\\u0915\\u094d\\u0937\\u092e \\u0915\\u0930\\u0947\\u0902\",\"set_default\":\"\\u0921\\u093f\\u092b\\u0949\\u0932\\u094d\\u091f \\u0938\\u0947\\u091f \\u0915\\u0930\\u0947\\u0902\",\"disable\":\"\\u0905\\u0915\\u094d\\u0937\\u092e\",\"user_statistics\":\"\\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e \\u0938\\u093e\\u0902\\u0916\\u094d\\u092f\\u093f\\u0915\\u0940\",\"pending\":\"\\u0905\\u092a\\u0942\\u0930\\u094d\\u0923\",\"total\":\"\\u0915\\u0941\\u0932\",\"overall_statistics\":\"\\u0915\\u0941\\u0932 \\u092e\\u093f\\u0932\\u093e\\u0915\\u0930 \\u0938\\u093e\\u0902\\u0916\\u094d\\u092f\\u093f\\u0915\\u0940\",\"payments_reports_in\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u092e\\u0947\\u0902 \\u0930\\u093f\\u092a\\u094b\\u0930\\u094d\\u091f\",\"demanding_quizzes\":\"\\u0915\\u0940 \\u092e\\u093e\\u0902\\u0917 \\u0915\\u0940 \\u0915\\u094d\\u0935\\u093f\\u091c\\u093c\",\"demanding\":\"\\u0915\\u0940 \\u092e\\u093e\\u0902\\u0917\",\"quizzes\":\" \\u091d\\u0915\\u094d\\u0915\\u0940 \\u0906\\u0926\\u092e\\u0940\",\"view_all\":\"\\u0938\\u092d\\u0940 \\u0915\\u094b \\u0926\\u0947\\u0916\\u0947\\u0902\",\"quiz_categories\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928\\u094b\\u0924\\u094d\\u0924\\u0930\\u0940 \\u0936\\u094d\\u0930\\u0947\\u0923\\u093f\\u092f\\u093e\\u0901\",\"subjects\":\"\\u0935\\u093f\\u0937\\u092f\\u094b\\u0902\",\"topics\":\"\\u0935\\u093f\\u0937\\u092f\",\"questions\":\"\\u092a\\u094d\\u0930\\u0936\\u0928\",\"payment_statistics\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u0938\\u093e\\u0902\\u0916\\u094d\\u092f\\u093f\\u0915\\u0940\",\"payment_monthly_statistics\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u092e\\u093e\\u0938\\u093f\\u0915 \\u0906\\u0901\\u0915\\u0921\\u093c\\u0947\",\"quizzes_usage\":\"Quizzes \\u0909\\u092a\\u092f\\u094b\\u0917\",\"paid_quizzes_usage\":\"\\u0905\\u0926\\u093e \\u0915\\u094d\\u0935\\u093f\\u091c\\u093c \\u0909\\u092a\\u092f\\u094b\\u0917\",\"import_excel\":\"\\u0906\\u092f\\u093e\\u0924 \\u090f\\u0915\\u094d\\u0938\\u0947\\u0932\",\"add_user\":\"\\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e \\u091c\\u094b\\u0921\\u093c\\u0947\\u0902\",\"name\":\"\\u0928\\u093e\\u092e\",\"email\":\"\\u0908\\u092e\\u0947\\u0932\",\"image\":\"\\u091b\\u0935\\u093f\",\"role\":\"\\u092d\\u0942\\u092e\\u093f\\u0915\\u093e\",\"send_sms\":\"\\u0938\\u0902\\u0926\\u0947\\u0936 \\u092d\\u0947\\u091c\\u094b\",\"sms_to\":\"\\u0915\\u0930\\u0928\\u0947 \\u0915\\u0947 \\u0932\\u093f\\u090f \\u090f\\u0938\\u090f\\u092e\\u090f\\u0938\",\"students\":\"\\u091b\\u093e\\u0924\\u094d\\u0930\",\"parents\":\"\\u092e\\u093e\\u0924\\u093e-\\u092a\\u093f\\u0924\\u093e\",\"admins\":\"\\u092c\\u0928\\u093e\\u0935\\u0947\\u0902\",\"for_category\":\"\\u0936\\u094d\\u0930\\u0947\\u0923\\u0940 \\u0915\\u0947 \\u0932\\u093f\\u090f\",\"all\":\"\\u0938\\u092c\",\"selected\":\"\\u091a\\u092f\\u0928\\u093f\\u0924\",\"message_template\":\"\\u0938\\u0902\\u0926\\u0947\\u0936 \\u0916\\u093e\\u0915\\u093e\",\"edit_user\":\"\\u092f\\u0942\\u091c\\u0930 \\u0915\\u094b \\u0938\\u0902\\u092a\\u093e\\u0926\\u093f\\u0924 \\u0915\\u0930\\u094b\",\"update\":\"\\u0905\\u0926\\u094d\\u092f\\u0924\\u0928\",\"this_field_is_required\":\"\\u092f\\u0939 \\u092b\\u093c\\u0940\\u0932\\u094d\\u0921 \\u0906\\u0935\\u0936\\u094d\\u092f\\u0915 \\u0939\\u0948\",\"the_text_is_too_short\":\"\\u092a\\u093e\\u0920 \\u092c\\u0939\\u0941\\u0924 \\u091b\\u094b\\u091f\\u093e \\u0939\\u0948\",\"the_text_is_too_long\":\"\\u0932\\u0947\\u0916 \\u092c\\u0939\\u0941\\u0924 \\u092c\\u0921\\u093c\\u093e \\u0939\\u0948\",\"invalid_input\":\"\\u0905\\u092e\\u093e\\u0928\\u094d\\u092f \\u0928\\u093f\\u0935\\u0947\\u0936\",\"username\":\"\\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e \\u0928\\u093e\\u092e\",\"please_enter_valid_email\":\"\\u0915\\u0943\\u092a\\u092f\\u093e \\u092e\\u093e\\u0928\\u094d\\u092f \\u0908\\u092e\\u0947\\u0932 \\u0915\\u094b \\u0926\\u0930\\u094d\\u091c \\u0915\\u0930\\u0947\\u0902\",\"select_role\":\"\\u092d\\u0942\\u092e\\u093f\\u0915\\u093e \\u0915\\u093e \\u091a\\u092f\\u0928\",\"phone\":\"\\u092b\\u093c\\u094b\\u0928\",\"please_enter_10-15_digit_mobile_number\":\"\\u0915\\u0943\\u092a\\u092f\\u093e 10-15 \\u0905\\u0902\\u0915 \\u092e\\u094b\\u092c\\u093e\\u0907\\u0932 \\u0928\\u0902\\u092c\\u0930 \\u0926\\u0930\\u094d\\u091c\",\"please_enter_valid_phone_number\":\"\\u0915\\u0943\\u092a\\u092f\\u093e \\u090f\\u0915 \\u0935\\u0948\\u0927 \\u0928\\u0902\\u092c\\u0930 \\u0921\\u093e\\u0932\\u0947\\u0902\",\"billing_address\":\"\\u092c\\u093f\\u0932 \\u092d\\u0947\\u091c\\u0928\\u0947 \\u0915\\u093e \\u092a\\u0924\\u093e\",\"please_enter_your_address\":\"\\u0915\\u0943\\u092a\\u092f\\u093e \\u0905\\u092a\\u0928\\u0947 \\u092a\\u0924\\u0947 \\u0926\\u0930\\u094d\\u091c\",\"file_type_not_allowed\":\"\\u092b\\u093c\\u093e\\u0907\\u0932 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930 \\u0915\\u0940 \\u0905\\u0928\\u0941\\u092e\\u0924\\u093f \\u0928\\u0939\\u0940\\u0902\",\"lms_categories\":\"\\u090f\\u0932\\u090f\\u092e\\u090f\\u0938 \\u0936\\u094d\\u0930\\u0947\\u0923\\u093f\\u092f\\u093e\\u0901\",\"category\":\"\\u0935\\u0930\\u094d\\u0917\",\"description\":\"\\u0935\\u093f\\u0935\\u0930\\u0923\",\"coupon_codes\":\"\\u0915\\u0942\\u092a\\u0928 \\u0915\\u094b\\u0921\",\"title\":\"\\u0936\\u0940\\u0930\\u094d\\u0937\\u0915\",\"type\":\"\\u092a\\u094d\\u0930\\u0915\\u093e\\u0930\",\"discount\":\"\\u091b\\u0942\\u091f\",\"minimum_bill\":\"\\u0928\\u094d\\u092f\\u0942\\u0928\\u0924\\u092e \\u092c\\u093f\\u0932\",\"maximum_discount\":\"\\u0905\\u0927\\u093f\\u0915\\u0924\\u092e \\u091b\\u0942\\u091f\",\"limit\":\"\\u0939\\u0926\",\"status\":\"\\u0938\\u094d\\u0925\\u093f\\u0924\\u093f\",\"examseries\":\"Examseries\",\"create_coupon\":\"\\u0915\\u0942\\u092a\\u0928 \\u092c\\u0928\\u093e\\u090f\\u0902\",\"coupon_code\":\"\\u0915\\u0942\\u092a\\u0928 \\u0915\\u094b\\u0921\",\"value\":\"\\u092e\\u0942\\u0932\\u094d\\u092f\",\"percent\":\"\\u092a\\u094d\\u0930\\u0924\\u093f\\u0936\\u0924\",\"discount_type\":\"\\u0921\\u093f\\u0938\\u094d\\u0915\\u093e\\u0909\\u0902\\u091f \\u0915\\u0947 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930\",\"discount_value\":\"\\u0921\\u093f\\u0938\\u094d\\u0915\\u093e\\u0909\\u0902\\u091f \\u092e\\u0942\\u0932\\u094d\\u092f\",\"enter_value\":\"\\u0926\\u0930\\u094d\\u091c \\u092e\\u0942\\u0932\\u094d\\u092f\",\"please_enter_valid_number\":\"\\u0915\\u0943\\u092a\\u092f\\u093e \\u0935\\u0948\\u0927 \\u0938\\u0902\\u0916\\u094d\\u092f\\u093e \\u0926\\u0930\\u094d\\u091c\",\"enter_minimum_bill\":\"\\u0928\\u094d\\u092f\\u0942\\u0928\\u0924\\u092e \\u092c\\u093f\\u0932 \\u0926\\u0930\\u094d\\u091c\",\"discount_maximum_amount\":\"\\u0921\\u093f\\u0938\\u094d\\u0915\\u093e\\u0909\\u0902\\u091f \\u0905\\u0927\\u093f\\u0915\\u0924\\u092e \\u0930\\u093e\\u0936\\u093f\",\"enter_maximum_amount\":\"\\u0905\\u0927\\u093f\\u0915\\u0924\\u092e \\u0930\\u093e\\u0936\\u093f \\u092e\\u0947\\u0902 \\u092a\\u094d\\u0930\\u0935\\u0947\\u0936\",\"valid_from\":\"\\u0938\\u0947 \\u092e\\u093e\\u0928\\u094d\\u092f\",\"valid_to\":\"\\u0907\\u0938 \\u0924\\u0915 \\u092e\\u093e\\u0928\\u094d\\u092f\",\"usage_limit\":\"\\u0909\\u092a\\u092f\\u094b\\u0917 \\u0915\\u0940 \\u0938\\u0940\\u092e\\u093e\",\"enter_usage_limit_per_user\":\"\\u092a\\u094d\\u0930\\u092f\\u094b\\u0917 \\u0938\\u0940\\u092e\\u093e \\u092a\\u094d\\u0930\\u0924\\u093f \\u0909\\u092a\\u092f\\u094b\\u0917\\u0915\\u0930\\u094d\\u0924\\u093e \\u0926\\u0930\\u094d\\u091c\",\"payments\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928\",\"export_payments_report\":\"\\u0928\\u093f\\u0930\\u094d\\u092f\\u093e\\u0924 \\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u0915\\u0940 \\u0930\\u093f\\u092a\\u094b\\u0930\\u094d\\u091f\",\"export_payment_records\":\"\\u0928\\u093f\\u0930\\u094d\\u092f\\u093e\\u0924 \\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u0930\\u093f\\u0915\\u0949\\u0930\\u094d\\u0921\\u094d\\u0938\",\"download_excel\":\"\\u0921\\u093e\\u0909\\u0928\\u0932\\u094b\\u0921 \\u090f\\u0915\\u094d\\u0938\\u0947\\u0932\",\"all_records\":\"\\u0938\\u092d\\u0940 \\u0930\\u093f\\u0915\\u0949\\u0930\\u094d\\u0921\",\"from_date\":\"\\u0924\\u093e\\u0930\\u0940\\u0916 \\u0938\\u0947\",\"to_date\":\"\\u0924\\u093e\\u0930\\u0940\\u0916 \\u0924\\u0915\",\"payment_type\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u0915\\u0947 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930\",\"online\":\"\\u0911\\u0928\\u0932\\u093e\\u0907\\u0928\",\"offline\":\"\\u0911\\u092b\\u0932\\u093e\\u0907\\u0928\",\"payment_status\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u0915\\u0940 \\u0938\\u094d\\u0925\\u093f\\u0924\\u093f\",\"start_date\":\"\\u0906\\u0930\\u0902\\u092d \\u0915\\u0930\\u0928\\u0947 \\u0915\\u0940 \\u0924\\u093f\\u0925\\u093f\",\"end_date\":\"\\u0905\\u0902\\u0924\\u093f\\u092e \\u0924\\u093f\\u0925\\u093f\",\"url\":\"\\u092f\\u0942\\u0906\\u0930\\u090f\\u0932\",\"create_message\":\"\\u0938\\u0902\\u0926\\u0947\\u0936 \\u0932\\u093f\\u0916\\u0947\",\"inbox\":\"\\u0907\\u0928\\u092c\\u0949\\u0915\\u094d\\u0938\",\"compose\":\"\\u0932\\u093f\\u0916\\u0928\\u093e\",\"feed_backs\":\"\\u092b\\u093c\\u0940\\u0921 \\u092a\\u0940\\u0920\",\"subject\":\"\\u0935\\u093f\\u0937\\u092f\",\"posted_on\":\"\\u092a\\u0930 \\u092a\\u094d\\u0930\\u0935\\u093f\\u0937\\u094d\\u091f \\u0915\\u093f\\u092f\\u093e\",\"view\":\"\\u0930\\u093e\\u092f\",\"from_email\":\"\\u0908 - \\u092e\\u0947\\u0932 \\u0938\\u0947\",\"from_name\":\"\\u0928\\u093e\\u092e \\u0938\\u0947\",\"module\":\"\\u092e\\u0949\\u0921\\u094d\\u092f\\u0942\\u0932\",\"key\":\"\\u0915\\u0941\\u0902\\u091c\\u0940\",\"create_series\":\"\\u0938\\u0940\\u0930\\u0940\\u091c \\u092c\\u0928\\u093e\\u090f\\u0902\",\"duration\":\"\\u0905\\u0935\\u0927\\u093f\",\"is_paid\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u0915\\u093f\\u092f\\u093e\",\"total_marks\":\"\\u0915\\u0941\\u0932 \\u092e\\u093e\\u0930\\u094d\\u0915\",\"update_questions\":\"\\u0938\\u0935\\u093e\\u0932 \\u0905\\u092a\\u0921\\u0947\\u091f\",\"paid\":\"\\u092d\\u0941\\u0917\\u0924\\u093e\\u0928 \\u0915\\u093f\\u092f\\u093e \\u0939\\u0948\",\"free\":\"\\u092e\\u0941\\u0915\\u094d\\u0924\",\"create_quiz\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928\\u094b\\u0924\\u094d\\u0924\\u0930\\u0940 \\u092c\\u0928\\u093e\\u090f\\u0902\",\"quiz_title\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928\\u094b\\u0924\\u094d\\u0924\\u0930\\u0940 \\u0936\\u0940\\u0930\\u094d\\u0937\\u0915\",\"enter_value_in_minutes\":\"\\u092e\\u0942\\u0932\\u094d\\u092f \\u092e\\u093f\\u0928\\u091f \\u092e\\u0947\\u0902 \\u0926\\u0930\\u094d\\u091c \\u0915\\u0930\\u0947\\u0902\",\"it_will_be_updated_by_adding_the_questions\":\"\\u092f\\u0939 \\u0938\\u0935\\u093e\\u0932 \\u091c\\u094b\\u0921\\u093c\\u0915\\u0930 \\u0905\\u0926\\u094d\\u092f\\u0924\\u0928 \\u0915\\u093f\\u092f\\u093e \\u091c\\u093e\\u090f\\u0917\\u093e\",\"pass_percentage\":\"\\u092a\\u093e\\u0938 \\u092a\\u094d\\u0930\\u0924\\u093f\\u0936\\u0924\",\"negative_mark\":\"\\u0928\\u0915\\u093e\\u0930\\u093e\\u0924\\u094d\\u092e\\u0915 \\u092e\\u093e\\u0930\\u094d\\u0915\",\"instructions_page\":\"\\u0928\\u093f\\u0930\\u094d\\u0926\\u0947\\u0936 \\u092a\\u0943\\u0937\\u094d\\u0920\",\"select\":\"\\u091a\\u0941\\u0928\\u0924\\u0947 \\u0939\\u0948\\u0902\",\"validity\":\"\\u0935\\u0948\\u0927\\u0924\\u093e\",\"validity_in_days\":\"\\u0935\\u0948\\u0927\\u0924\\u093e \\u0926\\u093f\\u0928\\u094b\\u0902 \\u092e\\u0947\\u0902\",\"cost\":\"\\u0932\\u093e\\u0917\\u0924\",\"total_exams\":\"\\u0915\\u0941\\u0932 \\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u093e\",\"total_questions\":\"\\u0915\\u0941\\u0932 \\u0938\\u0935\\u093e\\u0932\",\"update_quizzes\":\"\\u0905\\u0926\\u094d\\u092f\\u0924\\u0928 \\u0915\\u094d\\u0935\\u093f\\u091c\\u093c\",\"question_subjects\":\"\\u092a\\u094d\\u0930\\u0936\\u094d\\u0928 \\u0935\\u093f\\u0937\\u092f\\u094b\\u0902\",\"import_questions\":\"\\u0906\\u092f\\u093e\\u0924 \\u0938\\u0935\\u093e\\u0932\",\"add_subject\":\"\\u0935\\u093f\\u0937\\u092f \\u091c\\u094b\\u0921\\u093c\\u0928\\u0947\",\"view_questions\":\"\\u0938\\u0935\\u093e\\u0932\\u094b\\u0902 \\u0926\\u0947\\u0916\\u0947\\u0902\",\"content\":\"\\u0938\\u093e\\u092e\\u0917\\u094d\\u0930\\u0940\",\"subjects_list\":\"\\u0935\\u093f\\u0937\\u092f\\u094b\\u0902 \\u0938\\u0942\\u091a\\u0940\",\"import\":\"\\u0906\\u092f\\u093e\\u0924\",\"id\":\"\\u092a\\u0939\\u091a\\u093e\\u0928 \\u092a\\u0924\\u094d\\u0930\",\"topics_list\":\"\\u0935\\u093f\\u0937\\u092f \\u0938\\u0942\\u091a\\u0940\",\"parent\":\"\\u092e\\u093e\\u0924\\u093e-\\u092a\\u093f\\u0924\\u093e\",\"topic (id)\":\"\\u0935\\u093f\\u0937\\u092f (\\u0906\\u0908\\u0921\\u0940)\",\"lms_content\":\"\\u090f\\u0932\\u090f\\u092e\\u090f\\u0938 \\u0938\\u093e\\u092e\\u0917\\u094d\\u0930\\u0940\",\"lms_series\":\"\\u090f\\u0932\\u090f\\u092e\\u090f\\u0938 \\u0938\\u0940\\u0930\\u0940\\u091c\",\"total_items\":\"\\u0915\\u0941\\u0932 \\u0938\\u093e\\u092e\\u093e\\u0928\",\"update_lms\":\"\\u0905\\u0926\\u094d\\u092f\\u0924\\u0928 \\u092e\\u093e\\u0938\\u094d\\u0915\\u094b\",\"edit_language\":\"\\u092d\\u093e\\u0937\\u093e \\u0915\\u094b \\u0938\\u0902\\u092a\\u093e\\u0926\\u093f\\u0924\",\"language_title\":\"\\u092d\\u093e\\u0937\\u093e \\u0936\\u0940\\u0930\\u094d\\u0937\\u0915\",\"language_code\":\"\\u092d\\u093e\\u0937\\u093e \\u0915\\u094b\\u0921\",\"supported_language_codes\":\"\\u0938\\u092e\\u0930\\u094d\\u0925\\u093f\\u0924 \\u092d\\u093e\\u0937\\u093e \\u0915\\u094b\\u0921\",\"add_language\":\"\\u092d\\u093e\\u0937\\u093e \\u091c\\u094b\\u0921\\u093c\\u0947\",\"record_added_successfully\":\"\\u0930\\u093f\\u0915\\u093e\\u0930\\u094d\\u0921 \\u091c\\u094b\\u0921\\u093c\\u093e \\u0938\\u092b\\u0932\\u0924\\u093e\\u092a\\u0942\\u0930\\u094d\\u0935\\u0915\"}', '2016-11-18 10:10:50', '2018-04-02 02:53:10'),
(11, 'German', 'german', 'de', 0, 0, '{\"success\":\"Erfolg\",\"record_updated_successfully\":\"Datensatz erfolgreich aktualisiert\",\"languages\":\"Sprachen\",\"create\":\"Erstellen\",\"language\":\"Sprache\",\"code\":\"Code\",\"is_rtl\":\"Ist Rtl\",\"default_language\":\"Standardsprache\",\"action\":\"Aktion\",\"are_you_sure\":\"Bist du sicher\",\"you_will_not_be_able_to_recover_this_record\":\"Sie werden nicht in der Lage, diesen Rekord zu erholen\",\"yes\":\"ja\",\"delete_it\":\"L\\u00f6sche es\",\"no\":\"Nein\",\"cancel_please\":\"Abbrechen Bitte\",\"deleted\":\"Gel\\u00f6scht\",\"sorry\":\"Es tut uns leid\",\"cannot_delete_this_record_as\":\"Dieser Datensatz kann nicht gel\\u00f6scht werden\",\"your_record_has_been_deleted\":\"Ihr Eintrag wurde gel\\u00f6scht\",\"cancelled\":\"Abgebrochen\",\"your_record_is_safe\":\"Ihr Datensatz ist sicher\",\"latest_users\":\"Neueste Benutzer\",\"was_joined_as\":\"Registriert seit\",\"see_more\":\"Sehen Sie mehr\",\"my_profile\":\"Mein Profil\",\"change_password\":\"Passwort \\u00e4ndern\",\"logout\":\"Ausloggen\",\"dashboard\":\"Instrumententafel\",\"users\":\"Benutzer\",\"exams\":\"Pr\\u00fcfungen\",\"categories\":\"Kategorien\",\"question_bank\":\"Frage Bank\",\"quiz\":\"Quiz\",\"exam_series\":\"Pr\\u00fcfungsserie\",\"instructions\":\"Anleitung\",\"subjects_master\":\"Schlagw\\u00f6rter Master\",\"subject_topics\":\"Themengebiete\",\"coupons\":\"Gutscheine\",\"list\":\"Liste\",\"add\":\"Hinzuf\\u00fcgen\",\"lms\":\"lms\",\"contents\":\"Inhalt\",\"series\":\"Serie\",\"payment_reports\":\"Zahlungsberichte\",\"online_payments\":\"Online-Zahlungen\",\"offline_payments\":\"Offline-Zahlungen\",\"export\":\"Export\",\"notifications\":\"Benachrichtigungen\",\"messages\":\"Nachrichten\",\"feedback\":\"Feedback\",\"master_settings\":\"Master-Einstellungen\",\"email_templates\":\"E-Mail-Vorlagen\",\"settings\":\"Einstellungen\",\"update_strings\":\"Strings aktualisieren\",\"edit\":\"Bearbeiten\",\"delete\":\"L\\u00f6schen\",\"enable\":\"Aktivieren\",\"set_default\":\"Default einstellen\",\"disable\":\"Deaktivieren\",\"user_statistics\":\"Benutzerstatistik\",\"pending\":\"Ausstehend\",\"total\":\"Gesamt\",\"overall_statistics\":\"Gesamtstatistik\",\"payments_reports_in\":\"Zahlungen\",\"demanding_quizzes\":\"Anspruchsvolle Quiz\",\"demanding\":\"Anspruchsvoll\",\"quizzes\":\"quiz\",\"view_all\":\"Alle anzeigen\",\"quiz_categories\":\"Quiz Kategorien\",\"subjects\":\"F\\u00e4cher\",\"topics\":\"Themenbereiche\",\"questions\":\"Fragen\",\"payment_statistics\":\"Zahlungsstatistiken\",\"payment_monthly_statistics\":\"Zahlung Monatliche Statistiken\",\"quizzes_usage\":\"Quizfragen Verwendung\",\"paid_quizzes_usage\":\"Bezahlte Quizbenutzung\",\"import_excel\":\"Importieren Sie Excel\",\"add_user\":\"Benutzer hinzuf\\u00fcgen\",\"name\":\"Name\",\"email\":\"Email\",\"image\":\"Image\",\"role\":\"Rolle\",\"add_language\":\"Sprache hinzuf\\u00fcgen\",\"language_title\":\"Sprache Titel\",\"this_field_is_required\":\"Dieses Feld wird ben\\u00f6tigt\",\"the_text_is_too_short\":\"Der Text ist zu kurz\",\"the_text_is_too_long\":\"Der Text ist zu lang\",\"language_code\":\"Sprachcode\",\"supported_language_codes\":\"Unterst\\u00fctzte Sprachencodes\",\"category\":\"Kategorie\",\"description\":\"Beschreibung\",\"coupon_codes\":\"Gutscheincodes\",\"title\":\"Titel\",\"type\":\"Art\",\"discount\":\"Rabatt\",\"minimum_bill\":\"Mindestabrechnung\",\"maximum_discount\":\"Maximaler Rabatt\",\"limit\":\"Grenze\",\"status\":\"Status\",\"examseries\":\"Examseries\",\"create_coupon\":\"Gutschein erstellen\",\"invalid_input\":\"Ung\\u00fcltige Eingabe\",\"coupon_code\":\"Gutscheincode\",\"value\":\"Wert\",\"percent\":\"Prozent\",\"discount_type\":\"Erm\\u00e4\\u00dfigungstyp\",\"discount_value\":\"Rabattwert\",\"enter_value\":\"Wert eingeben\",\"please_enter_valid_number\":\"Bitte geben Sie die G\\u00fcltigkeitsnummer ein\",\"enter_minimum_bill\":\"Geben Sie den Mindestbetrag ein\",\"discount_maximum_amount\":\"Rabatt H\\u00f6chstbetrag\",\"enter_maximum_amount\":\"Geben Sie den H\\u00f6chstbetrag ein\",\"valid_from\":\"G\\u00fcltig ab\",\"valid_to\":\"G\\u00fcltig bis\",\"usage_limit\":\"Nutzungslimit\",\"enter_usage_limit_per_user\":\"Geben Sie Benutzungslimit pro Benutzer ein\",\"lms_categories\":\"Lms Kategorien\",\"create_category\":\"Kategorie erstellen\",\"category_name\":\"Kategoriename\",\"enter_category_name\":\"Geben Sie den Kategorienamen ein\",\"file_type_not_allowed\":\"Dateityp nicht zul\\u00e4ssig\",\"payments\":\"Zahlungen\",\"send_sms\":\"SMS senden\",\"sms_to\":\"Sms zu\",\"students\":\"Studenten\",\"parents\":\"Eltern\",\"admins\":\"Admins\",\"for_category\":\"F\\u00fcr Kategorie\",\"all\":\"Alle\",\"selected\":\"Ausgew\\u00e4hlt\",\"message_template\":\"Nachricht Vorlage\",\"start_date\":\"Anfangsdatum\",\"end_date\":\"Enddatum\",\"url\":\"url\",\"create_message\":\"Nachricht erstellen\",\"inbox\":\"Posteingang\",\"compose\":\"Komponieren\",\"feed_backs\":\"Zuf\\u00fchrungen\",\"subject\":\"Fach\",\"posted_on\":\"Ver\\u00f6ffentlicht am\",\"view\":\"Aussicht\",\"from_email\":\"Aus der Email\",\"from_name\":\"Von Namen\",\"module\":\"Modul\",\"key\":\"Schl\\u00fcssel\",\"record_added_successfully\":\"Datensatz erfolgreich hinzugef\\u00fcgt\"}', '2016-11-18 10:23:07', '2018-04-02 02:53:10'),
(12, 'Indonesian', 'indonesian', 'id', 0, 0, '{\"success\":\"Keberhasilan\",\"record_updated_successfully\":\"Rekam Updated Berhasil\",\"languages\":\"Bahasa\",\"create\":\"Membuat\",\"language\":\"Bahasa\",\"code\":\"Kode\",\"is_rtl\":\"Apakah Rtl\",\"default_language\":\"Bahasa default\",\"action\":\"Tindakan\",\"are_you_sure\":\"Apakah Anda Yakin\",\"you_will_not_be_able_to_recover_this_record\":\"Anda Tidak Akan Mampu Untuk Recover Rekam ini\",\"yes\":\"iya nih\",\"delete_it\":\"Hapus\",\"no\":\"Tidak\",\"cancel_please\":\"Batal Harap\",\"deleted\":\"dihapus\",\"sorry\":\"Maaf\",\"cannot_delete_this_record_as\":\"Tidak bisa Hapus Rekor ini Sebagai\",\"your_record_has_been_deleted\":\"Rekam Anda Telah Dihapus\",\"cancelled\":\"Dibatalkan\",\"your_record_is_safe\":\"Rekam Anda Apakah Aman\",\"latest_users\":\"Pengguna terbaru\",\"was_joined_as\":\"Itu Bergabung Sebagai\",\"see_more\":\"Lihat Lainnya\",\"my_profile\":\"Profil saya\",\"change_password\":\"Ganti kata sandi\",\"logout\":\"Keluar\",\"dashboard\":\"Dasbor\",\"users\":\"pengguna\",\"exams\":\"ujian\",\"categories\":\"kategori\",\"question_bank\":\"pertanyaan Bank\",\"quiz\":\"Ulangan\",\"exam_series\":\"ujian Series\",\"instructions\":\"petunjuk\",\"subjects_master\":\"subyek Guru\",\"subject_topics\":\"Topik subjek\",\"coupons\":\"kupon\",\"list\":\"Daftar\",\"add\":\"Menambahkan\",\"lms\":\"LMS\",\"contents\":\"Isi\",\"series\":\"Seri\",\"payment_reports\":\"Laporan Pembayaran\",\"online_payments\":\"Pembayaran online\",\"offline_payments\":\"Pembayaran Offline\",\"export\":\"Ekspor\",\"notifications\":\"pemberitahuan\",\"messages\":\"pesan\",\"feedback\":\"umpan balik\",\"master_settings\":\"Pengaturan Guru\",\"email_templates\":\"Template email\",\"settings\":\"pengaturan\",\"update_strings\":\"Strings pembaruan\",\"edit\":\"mengedit\",\"delete\":\"Menghapus\",\"enable\":\"Memungkinkan\",\"set_default\":\"Set standar\",\"disable\":\"melumpuhkan\",\"import_excel\":\"impor Excel\",\"add_user\":\"Tambahkan pengguna\",\"name\":\"Nama\",\"email\":\"E-mail\",\"image\":\"Gambar\",\"role\":\"Peran\",\"this_field_is_required\":\"Bagian ini diperlukan\",\"the_text_is_too_short\":\"Teks Apakah Terlalu Pendek\",\"the_text_is_too_long\":\"Teks Apakah Terlalu Panjang\",\"invalid_input\":\"valid Masukan\",\"username\":\"Nama pengguna\",\"please_enter_valid_email\":\"Silahkan Masukkan Email Valid\",\"select_role\":\"Pilih Peran\",\"phone\":\"Telepon\",\"please_enter_10-15_digit_mobile_number\":\"Silahkan Masukkan 10-15 Digit Nomor Handphone\",\"please_enter_valid_phone_number\":\"Silahkan Masukkan Nomor Telepon Hari\",\"billing_address\":\"alamat tagihan\",\"please_enter_your_address\":\"Silahkan Masukkan Alamat Anda\",\"file_type_not_allowed\":\"File Type Tidak Diizinkan\",\"quiz_categories\":\"kuis Kategori\",\"category\":\"Kategori\",\"description\":\"Deskripsi\",\"question_subjects\":\"pertanyaan Subyek\",\"import_questions\":\"impor Pertanyaan\",\"add_subject\":\"Tambahkan Subjek\",\"subject\":\"Subyek\",\"view_questions\":\"Lihat Pertanyaan\",\"quizzes\":\"kuis\",\"create_series\":\"Buat Series\",\"title\":\"Judul\",\"duration\":\"Lamanya\",\"is_paid\":\"Telah dibayar\",\"total_marks\":\"total Marks\",\"update_questions\":\"Perbarui Pertanyaan\",\"paid\":\"dibayar\",\"free\":\"Bebas\",\"cost\":\"Biaya\",\"validity\":\"Keabsahan\",\"total_exams\":\"total Ujian\",\"total_questions\":\"total Pertanyaan\",\"update_quizzes\":\"Update Kuis\",\"subjects_list\":\"Daftar mata pelajaran\",\"import\":\"Impor\",\"id\":\"id\",\"topics_list\":\"Daftar topik\",\"parent\":\"Induk\",\"topic (id)\":\"Topik (id)\",\"coupon_codes\":\"Kode kupon\",\"type\":\"Mengetik\",\"discount\":\"Diskon\",\"minimum_bill\":\"Bill minimum\",\"maximum_discount\":\"Paket maksimum\",\"limit\":\"Membatasi\",\"status\":\"Status\",\"select\":\"Memilih\",\"add_topic\":\"Tambahkan Topik\",\"topics\":\"Topik\",\"select_parent\":\"Pilih Induk\",\"topic_name\":\"topik Nama\",\"examseries\":\"Examseries\",\"create_coupon\":\"Buat kupon\",\"coupon_code\":\"Kode Kupon\",\"value\":\"Nilai\",\"percent\":\"Persen\",\"discount_type\":\"Jenis diskon\",\"discount_value\":\"diskon Nilai\",\"enter_value\":\"Masukkan Nilai\",\"please_enter_valid_number\":\"Silahkan Masukkan Nomor Hari\",\"enter_minimum_bill\":\"Masukkan Bill Minimum\",\"discount_maximum_amount\":\"Diskon Jumlah maksimum\",\"enter_maximum_amount\":\"Masukkan Jumlah maksimum\",\"valid_from\":\"Berlaku dari\",\"valid_to\":\"Hari Untuk\",\"usage_limit\":\"Batas penggunaan\",\"enter_usage_limit_per_user\":\"Masukkan Batas Penggunaan Per User\",\"pending\":\"tertunda\",\"total\":\"Total\",\"overall_statistics\":\"secara keseluruhan Statistik\",\"payments_reports_in\":\"Pembayaran Laporan Dalam\",\"payments\":\"pembayaran\",\"view_all\":\"Lihat semua\",\"payment_statistics\":\"Statistik pembayaran\",\"payment_monthly_statistics\":\"Statistik Bulanan Pembayaran\",\"export_payments_report\":\"Ekspor Pembayaran Laporan\",\"export_payment_records\":\"Rekaman ekspor Pembayaran\",\"download_excel\":\"Download Excel\",\"all_records\":\"semua Rekaman\",\"from_date\":\"Dari tanggal\",\"to_date\":\"Saat ini\",\"payment_type\":\"Tipe pembayaran\",\"all\":\"Semua\",\"online\":\"On line\",\"offline\":\"Offline\",\"payment_status\":\"Status pembayaran\",\"start_date\":\"Mulai tanggal\",\"end_date\":\"Tanggal akhir\",\"url\":\"url\",\"send_sms\":\"Kirim SMS\",\"sms_to\":\"sms Untuk\",\"students\":\"siswa\",\"parents\":\"Orangtua\",\"admins\":\"admin\",\"for_category\":\"untuk Kategori\",\"selected\":\"Terpilih\",\"message_template\":\"Template pesan\",\"create_message\":\"Menulis pesan\",\"inbox\":\"Inbox\",\"compose\":\"Menyusun\",\"feed_backs\":\"Punggung pakan\",\"posted_on\":\"Posted On\",\"view\":\"Melihat\",\"from_email\":\"Dari email\",\"from_name\":\"Dari nama\",\"module\":\"Modul\",\"key\":\"Kunci\",\"add_language\":\"Tambahkan Bahasa\",\"language_title\":\"bahasa Judul\",\"language_code\":\"Kode bahasa\",\"supported_language_codes\":\"Didukung Kode Bahasa\",\"record_added_successfully\":\"Rekam Ditambahkan Berhasil\"}', '2016-11-18 10:25:50', '2018-04-02 02:53:10'),
(13, 'Spanish', 'spanish', 'es', 0, 0, '{\"success\":\"\\u00c9xito\",\"record_updated_successfully\":\"Registro actualizado con \\u00e9xito\",\"languages\":\"Idiomas\",\"create\":\"Crear\",\"language\":\"Idioma\",\"code\":\"C\\u00f3digo\",\"is_rtl\":\"es Rtl\",\"default_language\":\"Idioma predeterminado\",\"action\":\"Acci\\u00f3n\",\"are_you_sure\":\"Est\\u00e1s seguro\",\"you_will_not_be_able_to_recover_this_record\":\"Usted no ser\\u00e1 capaz de recuperar este registro\",\"yes\":\"S\\u00ed\",\"delete_it\":\"B\\u00f3rralo\",\"no\":\"No\",\"cancel_please\":\"Cancelar por favor\",\"deleted\":\"Eliminado\",\"sorry\":\"Lo siento\",\"cannot_delete_this_record_as\":\"No se puede eliminar este registro como\",\"your_record_has_been_deleted\":\"Su registro ha sido eliminado\",\"cancelled\":\"Cancelado\",\"your_record_is_safe\":\"Su registro es seguro\",\"latest_users\":\"Usuarios m\\u00e1s recientes\",\"was_joined_as\":\"Fue unido a\",\"see_more\":\"Ver m\\u00e1s\",\"my_profile\":\"Mi perfil\",\"change_password\":\"Cambia la contrase\\u00f1a\",\"logout\":\"Cerrar sesi\\u00f3n\",\"dashboard\":\"Tablero\",\"users\":\"Usuarios\",\"exams\":\"ex\\u00e1menes\",\"categories\":\"Categor\\u00edas\",\"question_bank\":\"banco de preguntas\",\"quiz\":\"Examen\",\"exam_series\":\"Serie de ex\\u00e1menes\",\"instructions\":\"Instrucciones\",\"subjects_master\":\"Materias Master\",\"subject_topics\":\"Asunto Temas\",\"coupons\":\"cupones\",\"list\":\"Lista\",\"add\":\"A\\u00f1adir\",\"lms\":\"Lms\",\"contents\":\"Contenido\",\"series\":\"Serie\",\"payment_reports\":\"Informes de pago\",\"online_payments\":\"Pagos en l\\u00ednea\",\"offline_payments\":\"Pagos sin conexi\\u00f3n\",\"export\":\"Exportar\",\"notifications\":\"Notificaciones\",\"messages\":\"Mensajes\",\"feedback\":\"Realimentaci\\u00f3n\",\"master_settings\":\"Configuraci\\u00f3n maestra\",\"email_templates\":\"Plantillas de correo electr\\u00f3nico\",\"settings\":\"Ajustes\",\"update_strings\":\"Actualizar cadenas\",\"edit\":\"Editar\",\"delete\":\"Borrar\",\"enable\":\"Habilitar\",\"set_default\":\"Establecer predeterminado\",\"disable\":\"Inhabilitar\",\"user_statistics\":\"Estad\\u00edsticas de usuario\",\"pending\":\"Pendiente\",\"total\":\"Total\",\"overall_statistics\":\"Estad\\u00edsticas generales\",\"payments_reports_in\":\"Informes de pagos en\",\"demanding_quizzes\":\"Pruebas exigentes\",\"demanding\":\"Exigente\",\"quizzes\":\"Quizzes\",\"view_all\":\"Ver todo\",\"quiz_categories\":\"Categor\\u00edas del concurso\",\"subjects\":\"Asignaturas\",\"topics\":\"Temas\",\"questions\":\"Preguntas\",\"payment_statistics\":\"Estad\\u00edsticas de Pago\",\"payment_monthly_statistics\":\"Estad\\u00edsticas Mensuales de Pago\",\"quizzes_usage\":\"Uso de los cuestionarios\",\"paid_quizzes_usage\":\"Uso de cuestionarios pagados\",\"subjects_list\":\"Lista de temas\",\"import\":\"Importar\",\"id\":\"Carn\\u00e9 de identidad\",\"subject\":\"Tema\",\"import_excel\":\"Importar Excel\",\"add_user\":\"Agregar usuario\",\"name\":\"Nombre\",\"email\":\"Email\",\"image\":\"Imagen\",\"role\":\"Papel\",\"category\":\"Categor\\u00eda\",\"description\":\"Descripci\\u00f3n\",\"create_category\":\"Crear categor\\u00eda\",\"category_name\":\"nombre de la categor\\u00eda\",\"enter_category_name\":\"Ingrese el nombre de la categor\\u00eda\",\"this_field_is_required\":\"Este campo es requerido\",\"invalid_input\":\"entrada inv\\u00e1lida\",\"file_type_not_allowed\":\"Tipo de archivo no permitido\",\"question_subjects\":\"Temas de la pregunta\",\"import_questions\":\"Preguntas de importaci\\u00f3n\",\"add_subject\":\"A\\u00f1adir tema\",\"view_questions\":\"Ver preguntas\",\"create_series\":\"Crear serie\",\"title\":\"T\\u00edtulo\",\"duration\":\"Duraci\\u00f3n\",\"is_paid\":\"Est\\u00e1 pagado\",\"total_marks\":\"Notas totales\",\"cost\":\"Costo\",\"validity\":\"Validez\",\"total_exams\":\"Total de ex\\u00e1menes\",\"total_questions\":\"total de preguntas\",\"update_quizzes\":\"Actualizar los cuestionarios\",\"paid\":\"Pagado\",\"free\":\"Gratis\",\"coupon_codes\":\"C\\u00f3digos de cupones\",\"type\":\"Tipo\",\"discount\":\"Descuento\",\"minimum_bill\":\"facturaci\\u00f3n m\\u00ednima\",\"maximum_discount\":\"Descuento M\\u00e1ximo\",\"limit\":\"L\\u00edmite\",\"status\":\"Estado\",\"examseries\":\"Examseries\",\"create_coupon\":\"Crear cup\\u00f3n\",\"the_text_is_too_short\":\"El texto es demasiado corto\",\"the_text_is_too_long\":\"El texto es demasiado largo\",\"coupon_code\":\"C\\u00f3digo promocional\",\"value\":\"Valor\",\"percent\":\"Por ciento\",\"discount_type\":\"Tipo de descuento\",\"discount_value\":\"Valor de descuento\",\"enter_value\":\"Introducir valor\",\"please_enter_valid_number\":\"Ingrese un n\\u00famero v\\u00e1lido\",\"enter_minimum_bill\":\"Introduzca la factura m\\u00ednima\",\"discount_maximum_amount\":\"Importe m\\u00e1ximo de descuento\",\"enter_maximum_amount\":\"Introduzca la cantidad m\\u00e1xima\",\"valid_from\":\"V\\u00e1lida desde\",\"valid_to\":\"V\\u00e1lido hasta\",\"usage_limit\":\"L\\u00edmite de uso\",\"enter_usage_limit_per_user\":\"Introducir l\\u00edmite de uso por usuario\",\"lms_categories\":\"Lms Categor\\u00edas\",\"lms_content\":\"Contenido de LMS\",\"lms_series\":\"Serie Lms\",\"total_items\":\"Articulos totales\",\"update_lms\":\"Actualizar LMS\",\"payments\":\"pagos\",\"export_payments_report\":\"Informe de pagos de exportaci\\u00f3n\",\"export_payment_records\":\"Registros de pagos de exportaci\\u00f3n\",\"download_excel\":\"Descargar Excel\",\"all_records\":\"Todos los registros\",\"from_date\":\"Partir de la fecha\",\"to_date\":\"Hasta la fecha\",\"payment_type\":\"Tipo de pago\",\"all\":\"Todas\",\"online\":\"En l\\u00ednea\",\"offline\":\"Desconectado\",\"payment_status\":\"Estado de pago\",\"start_date\":\"Fecha de inicio\",\"end_date\":\"Fecha final\",\"url\":\"Url\",\"send_sms\":\"Enviar SMS\",\"sms_to\":\"Sms a\",\"students\":\"Estudiantes\",\"parents\":\"Padres\",\"admins\":\"Admins\",\"for_category\":\"para la categor\\u00eda\",\"selected\":\"Seleccionado\",\"message_template\":\"Plantilla de mensaje\",\"create_message\":\"Crear un mensaje\",\"inbox\":\"Bandeja de entrada\",\"compose\":\"Componer\",\"feed_backs\":\"Feed Backs\",\"posted_on\":\"Publicado en\",\"view\":\"Ver\",\"from_email\":\"Desde el e-mail\",\"from_name\":\"de nombre\",\"module\":\"M\\u00f3dulo\",\"key\":\"Llave\",\"add_language\":\"A\\u00f1adir Idioma\",\"language_title\":\"Idioma T\\u00edtulo\",\"language_code\":\"C\\u00f3digo de lenguaje\",\"supported_language_codes\":\"C\\u00f3digos de idioma compatibles\",\"record_added_successfully\":\"Registro agregado con \\u00e9xito\"}', '2016-11-18 10:28:54', '2018-04-02 02:53:10'),
(14, 'French', 'french', 'fr', 0, 0, '{\"success\":\"le succ\\u00e8s\",\"record_updated_successfully\":\"Enregistrement mis \\u00e0 jour avec succ\\u00e8s\",\"languages\":\"Langues\",\"create\":\"Cr\\u00e9er\",\"language\":\"La langue\",\"code\":\"Code\",\"is_rtl\":\"Est-ce que Rtl\",\"default_language\":\"Langage par d\\u00e9faut\",\"action\":\"action\",\"are_you_sure\":\"\\u00cates-vous s\\u00fbr\",\"you_will_not_be_able_to_recover_this_record\":\"Vous ne serez pas capable de r\\u00e9cup\\u00e9rer ce dossier\",\"yes\":\"Oui\",\"delete_it\":\"Supprime-le\",\"no\":\"Non\",\"cancel_please\":\"Annuler S\'il vous pla\\u00eet\",\"deleted\":\"Supprim\\u00e9\",\"sorry\":\"Pardon\",\"cannot_delete_this_record_as\":\"Impossible de supprimer ce fichier\",\"your_record_has_been_deleted\":\"Votre enregistrement a \\u00e9t\\u00e9 supprim\\u00e9\",\"cancelled\":\"Annul\\u00e9\",\"your_record_is_safe\":\"Votre dossier est s\\u00e9curitaire\",\"latest_users\":\"Derniers utilisateurs\",\"was_joined_as\":\"A \\u00e9t\\u00e9 rejoint comme\",\"see_more\":\"Voir plus\",\"my_profile\":\"Mon profil\",\"change_password\":\"Changer le mot de passe\",\"logout\":\"Se d\\u00e9connecter\",\"dashboard\":\"Tableau de bord\",\"users\":\"Utilisateurs\",\"exams\":\"Examens\",\"categories\":\"Cat\\u00e9gories\",\"question_bank\":\"Banque de questions\",\"quiz\":\"Quiz\",\"exam_series\":\"S\\u00e9rie d\'examens\",\"instructions\":\"Instructions\",\"subjects_master\":\"Sujets Master\",\"subject_topics\":\"Sujet Sujets\",\"coupons\":\"Bons de r\\u00e9duction\",\"list\":\"liste\",\"add\":\"Ajouter\",\"lms\":\"Lms\",\"contents\":\"Contenu\",\"series\":\"S\\u00e9ries\",\"payment_reports\":\"Rapports de paiement\",\"online_payments\":\"Paiements en ligne\",\"offline_payments\":\"Paiements en diff\\u00e9r\\u00e9\",\"export\":\"Exportation\",\"notifications\":\"Notifications\",\"messages\":\"messages\",\"feedback\":\"Retour d\'information\",\"master_settings\":\"Param\\u00e8tres ma\\u00eetre\",\"email_templates\":\"Mod\\u00e8les de courrier \\u00e9lectronique\",\"settings\":\"Param\\u00e8tres\",\"update_strings\":\"Mettre \\u00e0 jour les cha\\u00eenes\",\"edit\":\"modifier\",\"delete\":\"Effacer\",\"enable\":\"Activer\",\"set_default\":\"D\\u00e9finir par defaut\",\"disable\":\"D\\u00e9sactiver\",\"user_statistics\":\"Statistiques utilisateur\",\"pending\":\"en attendant\",\"total\":\"Total\",\"overall_statistics\":\"Statistiques g\\u00e9n\\u00e9rales\",\"payments_reports_in\":\"Rapports de paiements\",\"demanding_quizzes\":\"Demandes de tests\",\"demanding\":\"Exigeant\",\"quizzes\":\"Quiz\",\"view_all\":\"Voir tout\",\"quiz_categories\":\"Cat\\u00e9gories de quiz\",\"subjects\":\"Sujets\",\"topics\":\"Les sujets\",\"questions\":\"Les questions\",\"payment_statistics\":\"Statistiques de paiement\",\"payment_monthly_statistics\":\"Statistiques mensuelles de paiement\",\"quizzes_usage\":\"Utilisation des Quiz\",\"paid_quizzes_usage\":\"Utilisation des quiz pay\\u00e9s\",\"import_excel\":\"Importer Excel\",\"add_user\":\"Ajouter un utilisateur\",\"name\":\"pr\\u00e9nom\",\"email\":\"Email\",\"image\":\"image\",\"role\":\"R\\u00f4le\",\"category\":\"Cat\\u00e9gorie\",\"description\":\"La description\",\"question_subjects\":\"Question Sujets\",\"import_questions\":\"Questions d\'importation\",\"add_subject\":\"Ajouter un sujet\",\"subject\":\"Assujettir\",\"view_questions\":\"Afficher les questions\",\"title\":\"Titre\",\"is_paid\":\"Est pay\\u00e9\",\"cost\":\"Co\\u00fbt\",\"validity\":\"Validit\\u00e9\",\"total_exams\":\"Total des examens\",\"total_questions\":\"Total des questions\",\"content\":\"Contenu\",\"subjects_list\":\"Liste des sujets\",\"import\":\"Importer\",\"id\":\"Id\",\"topics_list\":\"Liste des sujets\",\"parent\":\"Parent\",\"topic (id)\":\"Sujet (id)\",\"coupon_codes\":\"Coupon Codes\",\"type\":\"Type\",\"discount\":\"Remise\",\"minimum_bill\":\"Projet de loi minimum\",\"maximum_discount\":\"Remise maximale\",\"limit\":\"Limite\",\"status\":\"statut\",\"examseries\":\"Examseries\",\"create_coupon\":\"Cr\\u00e9er un coupon\",\"this_field_is_required\":\"Ce champ est requis\",\"invalid_input\":\"entr\\u00e9e invalide\",\"the_text_is_too_short\":\"Le texte est trop court\",\"the_text_is_too_long\":\"Le texte est trop long\",\"coupon_code\":\"Coupon Code\",\"value\":\"Valeur\",\"percent\":\"Pour cent\",\"discount_type\":\"Type de remise\",\"discount_value\":\"R\\u00e9duction\",\"enter_value\":\"Entrez la valeur\",\"please_enter_valid_number\":\"Veuillez entrer un num\\u00e9ro valide\",\"enter_minimum_bill\":\"Saisir la facture minimale\",\"discount_maximum_amount\":\"Remise Montant maximum\",\"enter_maximum_amount\":\"Saisissez le montant maximal\",\"valid_from\":\"Valide \\u00e0 partir de\",\"valid_to\":\"Valable pour\",\"usage_limit\":\"Limite d\'utilisation\",\"enter_usage_limit_per_user\":\"Entrez la limite d\'utilisation par utilisateur\",\"lms_categories\":\"Lms Cat\\u00e9gories\",\"lms_content\":\"Lms Contenu\",\"lms_series\":\"S\\u00e9rie LMS\",\"total_items\":\"Total des articles\",\"update_lms\":\"Mise \\u00e0 jour LMS\",\"paid\":\"Pay\\u00e9\",\"free\":\"Gratuit\",\"payments\":\"Paiements\",\"export_payments_report\":\"Rapport sur les paiements \\u00e0 l\'exportation\",\"export_payment_records\":\"Enregistrement des paiements d\'exportation\",\"download_excel\":\"T\\u00e9l\\u00e9charger Excel\",\"all_records\":\"Tous les records\",\"from_date\":\"Partir de la date\",\"to_date\":\"\\u00c0 ce jour\",\"payment_type\":\"Type de paiement\",\"all\":\"Tout\",\"online\":\"En ligne\",\"offline\":\"Hors ligne\",\"payment_status\":\"Statut de paiement\",\"start_date\":\"Date de d\\u00e9but\",\"end_date\":\"Date de fin\",\"url\":\"Url\",\"send_sms\":\"Envoyer un SMS\",\"sms_to\":\"Sms \\u00e0\",\"students\":\"\\u00c9l\\u00e8ves\",\"parents\":\"Des parents\",\"admins\":\"Administrateurs\",\"for_category\":\"Pour la cat\\u00e9gorie\",\"selected\":\"Choisi\",\"message_template\":\"Mod\\u00e8le de message\",\"create_message\":\"Cr\\u00e9er un message\",\"inbox\":\"Bo\\u00eete de r\\u00e9ception\",\"compose\":\"Composer\",\"feed_backs\":\"Alimentation\",\"posted_on\":\"Post\\u00e9 sur\",\"view\":\"Vue\",\"from_email\":\"De l\'email\",\"from_name\":\"De Nom\",\"module\":\"Module\",\"key\":\"Cl\\u00e9\",\"edit_user\":\"Modifier l\'utilisateur\",\"update\":\"Mettre \\u00e0 jour\",\"username\":\"Nom d\'utilisateur\",\"please_enter_valid_email\":\"Veuillez saisir un email valide\",\"select_role\":\"S\\u00e9lectionner le r\\u00f4le\",\"phone\":\"T\\u00e9l\\u00e9phone\",\"please_enter_10-15_digit_mobile_number\":\"Entrez un num\\u00e9ro mobile de 10 \\u00e0 15 chiffres\",\"please_enter_valid_phone_number\":\"S\'il vous plait entrez un num\\u00e9ro de t\\u00e9l\\u00e9phone valide\",\"billing_address\":\"Adresse de facturation\",\"please_enter_your_address\":\"Veuillez entrer votre adresse\",\"file_type_not_allowed\":\"Type de fichier non autoris\\u00e9\",\"add_language\":\"Ajouter une langue\",\"language_title\":\"Titre du langage\",\"language_code\":\"Code de langue\",\"supported_language_codes\":\"Codes de langue pris en charge\",\"record_added_successfully\":\"Enregistrement ajout\\u00e9 avec succ\\u00e8s\",\"exam_types\":\"Exam Types\",\"themes\":\"Themes\",\"please_wait\":\"Please Wait\",\"subscribed_users\":\"Subscribed Users\",\"subscribe\":\"Subscribe\",\"practice_exams_and_exam_categories\":\"Practice Exams And Exam Categories\",\"browse_all_categories\":\"Browse All Categories\",\"create_account\":\"Create Account\",\"sign_in\":\"Sign In\",\"home\":\"Home\",\"practice_exams\":\"Practice Exams\",\"courses\":\"Courses\",\"pattren\":\"Pattren\",\"pricing\":\"Pricing\",\"syllabus\":\"Syllabus\",\"about_us\":\"About Us\",\"contact_us\":\"Contact Us\",\"follow_us_on\":\"Follow Us On\",\"terms_and_conditions\":\"Terms And Conditions\",\"privacy_and_policy\":\"Privacy And Policy\",\"start_exam\":\"Commencer l\'examen\",\"browse_all_exams\":\"Parcourir tous les examens\",\"free_exams\":\"Examens gratuits\",\"paid_exams\":\"Examens payants\",\"learning_management_system\":\"Apprentissage syst\\u00e8me de gestion\",\"about-us\":\"\\u00c0 propos de nous\",\"contact_our_experts_now\":\"Contactez nos experts maintenant\",\"feel_free_to_contact\":\"H\\u00e9sitez pas \\u00e0 contacter\",\"send_message\":\"Envoyer le message\",\"our_contact_details\":\"Nos coordonn\\u00e9es\",\"please enter your name\":\"S\'il vous pla\\u00eet entrez votre nom\",\"please enter your message\":\"S\'il vous pla\\u00eet entrer votre message\",\"please enter your subject\":\"Veuillez entrer votre sujet\",\"please enter your phone number\":\"S\'il vous plait, entrez votre num\\u00e9ro de t\\u00e9l\\u00e9phone\",\"please provide a valid email\":\"Veuillez fournir un courriel valide\",\"please enter a valid email address\":\"S\'il vous pla\\u00eet, mettez une adresse email valide\",\"congratulations\":\"Toutes nos f\\u00e9licitations\",\"your_message_was_sent_our_team_will_contact_you_soon\":\"Votre message a \\u00e9t\\u00e9 envoy\\u00e9 Notre \\u00e9quipe vous contactera bient\\u00f4t\"}', '2016-11-18 10:33:35', '2018-04-02 02:53:10');
INSERT INTO `languages` (`id`, `language`, `slug`, `code`, `is_rtl`, `is_default`, `phrases`, `created_at`, `updated_at`) VALUES
(15, 'Dutch', 'dutch', 'nl', 0, 0, '{\"success\":\"Succes\",\"record_updated_successfully\":\"Record Bijgewerkt succesvol\",\"languages\":\"talen\",\"create\":\"cre\\u00ebren\",\"language\":\"Taal\",\"code\":\"Code\",\"is_rtl\":\"is Rtl\",\"default_language\":\"Standaard taal\",\"action\":\"Actie\",\"are_you_sure\":\"Weet je het zeker\",\"you_will_not_be_able_to_recover_this_record\":\"Je zult niet in staat om dit record te herstellen\",\"yes\":\"Ja\",\"delete_it\":\"Verwijder het\",\"no\":\"Nee\",\"cancel_please\":\"annuleren Gelieve\",\"deleted\":\"verwijderde\",\"sorry\":\"Sorry\",\"cannot_delete_this_record_as\":\"Kan niet verwijderen Dit record als\",\"your_record_has_been_deleted\":\"Uw record is verwijderd\",\"cancelled\":\"Geannuleerd\",\"your_record_is_safe\":\"Uw Record Is Safe\",\"latest_users\":\"Laatste gebruikers\",\"was_joined_as\":\"Werd aangesteld als\",\"see_more\":\"Bekijk meer\",\"my_profile\":\"Mijn profiel\",\"change_password\":\"Verander wachtwoord\",\"logout\":\"Uitloggen\",\"dashboard\":\"Dashboard\",\"users\":\"gebruikers\",\"exams\":\"examens\",\"categories\":\"Categorie\\u00ebn\",\"question_bank\":\"vraag Bank\",\"quiz\":\"Quiz\",\"exam_series\":\"examen Series\",\"instructions\":\"instructies\",\"subjects_master\":\"onderwerpen Master\",\"subject_topics\":\"onderwerp Topics\",\"coupons\":\"coupons\",\"list\":\"Lijst\",\"add\":\"Toevoegen\",\"lms\":\"lms\",\"contents\":\"Inhoud\",\"series\":\"Serie\",\"payment_reports\":\"betaling Reports\",\"online_payments\":\"online betalingen\",\"offline_payments\":\"offline betalingen\",\"export\":\"Exporteren\",\"notifications\":\"meldingen\",\"messages\":\"berichten\",\"feedback\":\"terugkoppeling\",\"master_settings\":\"Master-instellingen\",\"email_templates\":\"email Templates\",\"settings\":\"instellingen\",\"update_strings\":\"Strings bijwerken\",\"edit\":\"Bewerk\",\"delete\":\"Verwijder\",\"enable\":\"in staat stellen\",\"set_default\":\"Standaard instellen\",\"disable\":\"onbruikbaar maken\",\"import_excel\":\"import Excel\",\"add_user\":\"Voeg gebruiker toe\",\"name\":\"Naam\",\"email\":\"E-mail\",\"image\":\"Beeld\",\"role\":\"Rol\",\"user_statistics\":\"Gebruikers Statistieken\",\"pending\":\"in afwachting van\",\"total\":\"Totaal\",\"overall_statistics\":\"Overall Statistieken\",\"payments_reports_in\":\"Betalingen Rapporten In\",\"demanding_quizzes\":\"veeleisende Quizzen\",\"demanding\":\"veeleisende\",\"quizzes\":\"quizzen\",\"view_all\":\"Bekijk alles\",\"quiz_categories\":\"Quiz Categorie\\u00ebn\",\"subjects\":\"vakken\",\"topics\":\"onderwerpen\",\"questions\":\"vragen\",\"payment_statistics\":\"betaling Statistieken\",\"payment_monthly_statistics\":\"Betaling Maandoverzicht\",\"quizzes_usage\":\"quizzen Usage\",\"paid_quizzes_usage\":\"Betaalde Quizzen Usage\",\"add_language\":\"Voeg Taal\",\"language_title\":\"taal Titel\",\"this_field_is_required\":\"Dit veld is verplicht\",\"the_text_is_too_short\":\"De tekst is te Kort\",\"the_text_is_too_long\":\"De tekst is te lang\",\"language_code\":\"taalcode\",\"supported_language_codes\":\"Ondersteunde Taalcodes\",\"category\":\"Categorie\",\"description\":\"Beschrijving\",\"question_subjects\":\"vraag onderwerpen\",\"import_questions\":\"vragen importeren\",\"add_subject\":\"Voeg een onderwerp toe\",\"subject\":\"Onderwerpen\",\"view_questions\":\"Bekijk vragen\",\"create_series\":\"Maak Series\",\"title\":\"Titel\",\"duration\":\"Duur\",\"is_paid\":\"Is betaald\",\"total_marks\":\"Totaal Marks\",\"update_questions\":\"bijwerken vragen\",\"paid\":\"Betaald\",\"free\":\"Gratis\",\"cost\":\"Kosten\",\"validity\":\"deugdelijkheid\",\"total_exams\":\"Totaal Examens\",\"total_questions\":\"Totaal vragen\",\"update_quizzes\":\"update Quizzen\",\"content\":\"Inhoud\",\"subjects_list\":\"onderwerpen Lijst\",\"import\":\"Importeren\",\"id\":\"Id\",\"topics_list\":\"onderwerpen Lijst\",\"parent\":\"Ouder\",\"topic (id)\":\"Topic (id)\",\"coupon_codes\":\"Kortingscodes\",\"type\":\"Type\",\"discount\":\"Korting\",\"minimum_bill\":\"minimum Bill\",\"maximum_discount\":\"maximum Discount\",\"limit\":\"Begrenzing\",\"status\":\"toestand\",\"examseries\":\"Examseries\",\"create_coupon\":\"Maak Coupon\",\"invalid_input\":\"ongeldige invoer\",\"coupon_code\":\"coupon code\",\"value\":\"Waarde\",\"percent\":\"procent\",\"discount_type\":\"Discount Type\",\"discount_value\":\"Discount Value\",\"enter_value\":\"Enter Value\",\"please_enter_valid_number\":\"Voer geldige Number\",\"enter_minimum_bill\":\"Voer Minimum Bill\",\"discount_maximum_amount\":\"Discount Maximumbedrag\",\"enter_maximum_amount\":\"Voer Maximumbedrag\",\"valid_from\":\"Geldig vanaf\",\"valid_to\":\"Geldig tot\",\"usage_limit\":\"gebruik Limit\",\"enter_usage_limit_per_user\":\"Voer Usage Limit per gebruiker\",\"lms_categories\":\"lms Categorie\\u00ebn\",\"lms_content\":\"lms Content\",\"lms_series\":\"lms Series\",\"total_items\":\"Total items\",\"update_lms\":\"update Lms\",\"payments\":\"betalingen\",\"export_payments_report\":\"Export Payments Report\",\"export_payment_records\":\"Export Betaling Records\",\"download_excel\":\"Download Excel\",\"all_records\":\"alle records\",\"from_date\":\"Van datum\",\"to_date\":\"Daten\",\"payment_type\":\"Betalingswijze\",\"all\":\"Alle\",\"online\":\"Online\",\"offline\":\"offline\",\"payment_status\":\"Betalingsstatus\",\"start_date\":\"Begin datum\",\"end_date\":\"Einddatum\",\"url\":\"url\",\"send_sms\":\"Verstuur sms\",\"sms_to\":\"sMS naar\",\"students\":\"leerlingen\",\"parents\":\"Ouders\",\"admins\":\"Admins\",\"for_category\":\"voor Categorie\",\"selected\":\"Gekozen\",\"message_template\":\"Template Message\",\"create_message\":\"Cree\\u00ebr bericht\",\"inbox\":\"inbox\",\"compose\":\"Componeren\",\"feed_backs\":\"Feed Backs\",\"posted_on\":\"Geplaatst op\",\"view\":\"Uitzicht\",\"from_email\":\"Van email\",\"from_name\":\"Van naam\",\"module\":\"module\",\"key\":\"sleutel\",\"record_added_successfully\":\"Record succesvol toegevoegd\",\"info\":\"info\",\"operations_are_disabled_in_demo_version\":\"Zijn uitgeschakeld In Demo Version\"}', '2016-11-18 10:38:15', '2018-04-02 02:53:10'),
(16, 'Portuguese', 'portuguese', 'pt', 0, 0, '{\"success\":\"Sucesso\",\"record_updated_successfully\":\"Registro atualizado com \\u00eaxito\",\"languages\":\"Idiomas\",\"create\":\"Crio\",\"language\":\"L\\u00edngua\",\"code\":\"C\\u00f3digo\",\"is_rtl\":\"\\u00c9 Rtl\",\"default_language\":\"Idioma padr\\u00e3o\",\"action\":\"A\\u00e7ao\",\"are_you_sure\":\"Voc\\u00ea tem certeza\",\"you_will_not_be_able_to_recover_this_record\":\"Voc\\u00ea n\\u00e3o ser\\u00e1 capaz de recuperar este registro\",\"yes\":\"sim\",\"delete_it\":\"Delete isso\",\"no\":\"N\\u00e3o\",\"cancel_please\":\"Cancelar por favor\",\"deleted\":\"Eliminado\",\"sorry\":\"Desculpa\",\"cannot_delete_this_record_as\":\"N\\u00e3o \\u00e9 poss\\u00edvel excluir este registro como\",\"your_record_has_been_deleted\":\"Seu registro foi exclu\\u00eddo\",\"cancelled\":\"Cancelado\",\"your_record_is_safe\":\"Seu registro \\u00e9 seguro\",\"latest_users\":\"Usu\\u00e1rios mais recentes\",\"was_joined_as\":\"Foi associado como\",\"see_more\":\"Ver mais\",\"my_profile\":\"Meu perfil\",\"change_password\":\"Mudar senha\",\"logout\":\"Sair\",\"dashboard\":\"Dashboard\",\"users\":\"Usu\\u00e1rios\",\"exams\":\"Exames\",\"categories\":\"Categorias\",\"question_bank\":\"Banco de perguntas\",\"quiz\":\"Question\\u00e1rio\",\"exam_series\":\"S\\u00e9rie de Exames\",\"instructions\":\"Instru\\u00e7\\u00f5es\",\"subjects_master\":\"Assuntos Mestre\",\"subject_topics\":\"T\\u00f3picos de Assunto\",\"coupons\":\"Cup\\u00f5es\",\"list\":\"Lista\",\"add\":\"Adicionar\",\"lms\":\"Lms\",\"contents\":\"Conte\\u00fado\",\"series\":\"S\\u00e9rie\",\"payment_reports\":\"Relat\\u00f3rios de pagamento\",\"online_payments\":\"Pagamentos on-line\",\"offline_payments\":\"Pagamentos off-line\",\"export\":\"Exportar\",\"notifications\":\"Notifica\\u00e7\\u00f5es\",\"messages\":\"Mensagens\",\"feedback\":\"Coment\\u00e1rios\",\"master_settings\":\"Configura\\u00e7\\u00f5es mestre\",\"email_templates\":\"Modelos de e-mail\",\"settings\":\"Configura\\u00e7\\u00f5es\",\"update_strings\":\"Atualizar seq\\u00fc\\u00eancias de caracteres\",\"edit\":\"Editar\",\"delete\":\"Excluir\",\"enable\":\"Habilitar\",\"set_default\":\"Conjunto padr\\u00e3o\",\"disable\":\"Desativar\",\"user_statistics\":\"Estat\\u00edsticas do usu\\u00e1rio\",\"pending\":\"Pendente\",\"total\":\"Total\",\"overall_statistics\":\"Estat\\u00edsticas gerais\",\"payments_reports_in\":\"Relat\\u00f3rios de pagamentos em\",\"demanding_quizzes\":\"Testes exigentes\",\"demanding\":\"Exigente\",\"quizzes\":\"Quizzes\",\"view_all\":\"Ver tudo\",\"quiz_categories\":\"Categorias de Quiz\",\"subjects\":\"assuntos\",\"topics\":\"T\\u00f3picos\",\"questions\":\"Quest\\u00f5es\",\"payment_statistics\":\"Estat\\u00edsticas de Pagamentos\",\"payment_monthly_statistics\":\"Estat\\u00edsticas Mensais de Pagamento\",\"quizzes_usage\":\"Uso de question\\u00e1rios\",\"paid_quizzes_usage\":\"Uso de question\\u00e1rios pagos\",\"import_excel\":\"Importar Excel\",\"add_user\":\"Adicionar usu\\u00e1rio\",\"name\":\"Nome\",\"email\":\"O email\",\"image\":\"Imagem\",\"role\":\"Fun\\u00e7\\u00e3o\",\"category\":\"Categoria\",\"description\":\"Descri\\u00e7\\u00e3o\",\"question_subjects\":\"Pergunta\",\"import_questions\":\"Importar perguntas\",\"add_subject\":\"Adicionar assunto\",\"subject\":\"Sujeito\",\"view_questions\":\"Ver perguntas\",\"create_series\":\"Criar S\\u00e9rie\",\"title\":\"T\\u00edtulo\",\"duration\":\"Dura\\u00e7\\u00e3o\",\"is_paid\":\"\\u00c9 pago\",\"total_marks\":\"Marcas totais\",\"update_questions\":\"Perguntas de atualiza\\u00e7\\u00e3o\",\"paid\":\"Pago\",\"free\":\"Livre\",\"cost\":\"Custo\",\"validity\":\"Validade\",\"total_exams\":\"Exames totais\",\"total_questions\":\"Total de perguntas\",\"update_quizzes\":\"Atualizar Quizzes\",\"content\":\"Conte\\u00fado\",\"topics_list\":\"Lista de t\\u00f3picos\",\"import\":\"Importar\",\"parent\":\"Pai\",\"topic (id)\":\"T\\u00f3pico (id)\",\"coupon_codes\":\"C\\u00f3digos de cup\\u00e3o\",\"type\":\"Digitar\",\"discount\":\"Desconto\",\"minimum_bill\":\"Conta m\\u00ednima\",\"maximum_discount\":\"Desconto m\\u00e1ximo\",\"limit\":\"Limite\",\"status\":\"Status\",\"examseries\":\"Examseries\",\"create_coupon\":\"Criar cupom\",\"this_field_is_required\":\"Este campo \\u00e9 obrigat\\u00f3rio\",\"invalid_input\":\"entrada inv\\u00e1lida\",\"the_text_is_too_short\":\"O texto \\u00e9 muito curto\",\"the_text_is_too_long\":\"O texto \\u00e9 muito longo\",\"coupon_code\":\"C\\u00f3digo do cupom\",\"value\":\"Valor\",\"percent\":\"Por cento\",\"discount_type\":\"Tipo de desconto\",\"discount_value\":\"Valor de desconto\",\"enter_value\":\"Inserir valor\",\"please_enter_valid_number\":\"Insira o n\\u00famero v\\u00e1lido\",\"enter_minimum_bill\":\"Inserir Conta M\\u00ednima\",\"discount_maximum_amount\":\"Valor m\\u00e1ximo do desconto\",\"enter_maximum_amount\":\"Insira o valor m\\u00e1ximo\",\"valid_from\":\"V\\u00e1lido de\",\"valid_to\":\"Valido para\",\"usage_limit\":\"Limite de uso\",\"enter_usage_limit_per_user\":\"Inserir limite de uso por usu\\u00e1rio\",\"lms_categories\":\"Lms Categorias\",\"lms_content\":\"Conte\\u00fado do Lms\",\"lms_series\":\"S\\u00e9rie Lms\",\"total_items\":\"Total de itens\",\"update_lms\":\"Atualizar LMS\",\"payments\":\"Pagamentos\",\"export_payments_report\":\"Relat\\u00f3rio de pagamentos de exporta\\u00e7\\u00e3o\",\"export_payment_records\":\"Exportar Registros de Pagamento\",\"download_excel\":\"Fa\\u00e7a o download do Excel\",\"all_records\":\"Todos os registros\",\"from_date\":\"Da data\",\"to_date\":\"A data\",\"payment_type\":\"Tipo de pagamento\",\"all\":\"Todos\",\"online\":\"Conectados\",\"offline\":\"Offline\",\"payment_status\":\"Status do pagamento\",\"start_date\":\"Data de in\\u00edcio\",\"end_date\":\"Data final\",\"url\":\"Url\",\"send_sms\":\"Enviar SMS\",\"sms_to\":\"SMS para\",\"students\":\"Estudantes\",\"parents\":\"Pais\",\"admins\":\"Administradores\",\"for_category\":\"Para a categoria\",\"selected\":\"Selecionado\",\"message_template\":\"Modelo de mensagem\",\"create_message\":\"Criar Mensagem\",\"inbox\":\"Caixa de entrada\",\"compose\":\"Compor\",\"feed_backs\":\"Feed Backs\",\"posted_on\":\"Postado em\",\"view\":\"Vis\\u00e3o\",\"from_email\":\"De e-mail\",\"from_name\":\"De nome\",\"site_title\":\"titulo do site\",\"edit_user\":\"Editar usu\\u00e1rio\",\"update\":\"Atualizar\",\"please_enter_valid_email\":\"Digite um e-mail v\\u00e1lido\",\"select_role\":\"Selecionar fun\\u00e7\\u00e3o\",\"add_language\":\"Adicionar idioma\",\"language_title\":\"T\\u00edtulo da L\\u00edngua\",\"language_code\":\"C\\u00f3digo de idioma\",\"supported_language_codes\":\"C\\u00f3digos de idioma suportados\",\"edit_language\":\"Editar idioma\",\"add_users\":\"Adicionar usu\\u00e1rios\",\"create_category\":\"Criar categoria\",\"category_name\":\"Nome da Categoria\",\"please_upload_valid_image_type\":\"Carregar o tipo de imagem v\\u00e1lido\",\"edit_author\":\"Editar Autor\",\"subject_title\":\"Assunto T\\u00edtulo\",\"subject_code\":\"C\\u00f3digo do assunto\",\"is_lab\":\"\\u00e9 laborat\\u00f3rio\",\"is_elective\":\"\\u00e9 eletivo\"}', '2016-11-18 10:42:06', '2018-04-02 02:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `lmscategories`
--

CREATE TABLE `lmscategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lmscontents`
--

CREATE TABLE `lmscontents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `content_type` enum('file','video','audio','url','video_url','audio_url','iframe') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'file',
  `is_url` tinyint(1) NOT NULL DEFAULT '0',
  `file_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lmsseries`
--

CREATE TABLE `lmsseries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `cost` decimal(10,2) NOT NULL,
  `validity` int(11) NOT NULL,
  `total_items` int(11) NOT NULL,
  `lms_category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `record_updated_by` int(11) NOT NULL,
  `show_in_front` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_popular` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lmsseries_data`
--

CREATE TABLE `lmsseries_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lmsseries_id` bigint(20) UNSIGNED NOT NULL,
  `lmscontent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messenger_participants`
--

CREATE TABLE `messenger_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `last_read` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messenger_threads`
--

CREATE TABLE `messenger_threads` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2019_05_22_131357_pages', 1),
('2019_05_24_121345_faqcategories', 1),
('2019_05_24_122523_faqs', 1),
('2019_05_27_125610_add_is_verified_to_users_table', 1),
('2019_05_27_131147_add_activation_code_to_users_table', 1),
('2019_05_28_102010_create_blogs_table', 1),
('2019_05_29_142007_academicprofiles', 1),
('2019_05_29_142801_activities', 1),
('2019_05_29_143201_projects', 1),
('2019_05_30_042323_resumetemplates', 1),
('2019_05_30_043045_technicalskills', 1),
('2019_05_30_043422_workexperience', 1),
('2019_05_30_044055_add_qualification_to_users_table', 1),
('2019_05_30_044628_add_department_to_users_table', 1),
('2019_05_30_044905_add_college_name_to_users_table', 1),
('2019_05_30_045047_add_college_place_to_users_table', 1),
('2019_05_30_045303_add_state_to_users_table', 1),
('2019_05_30_045426_add_country_to_users_table', 1),
('2019_05_30_045544_add_field_of_interest_to_users_table', 1),
('2019_05_30_045706_add_subject_taught_to_users_table', 1),
('2019_05_30_045953_add_gender_to_users_table', 1),
('2019_05_30_050112_add_dob_to_users_table', 1),
('2019_05_30_050332_add_marital_status_to_users_table', 1),
('2019_05_30_050502_add_nationality_to_users_table', 1),
('2019_05_30_050619_add_father_name_to_users_table', 1),
('2019_05_30_050727_add_linguistic_ability_to_users_table', 1),
('2019_05_30_050830_add_passport_number_to_users_table', 1),
('2019_05_30_050929_add_present_address_to_users_table', 1),
('2019_05_30_051034_add_personal_strength_to_users_table', 1),
('2019_05_30_051144_add_roll_no_to_users_table', 1),
('2019_05_30_053124_drop_class_columns_from_resumetemplates', 1),
('2019_05_30_054232_add_slug_to_resumetemplates_table', 1),
('2019_06_10_045419_add_career_objective_to_users_table', 1),
('2019_06_10_045611_add_declaration_to_user_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valid_from` date NOT NULL,
  `valid_to` date NOT NULL,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `plan_type` enum('combo','lms','exam','other') COLLATE utf8_unicode_ci NOT NULL,
  `payment_gateway` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid_by_parent` tinyint(1) NOT NULL DEFAULT '0',
  `paid_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `coupon_applied` tinyint(4) NOT NULL DEFAULT '0',
  `coupon_id` int(11) NOT NULL,
  `actual_cost` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `after_discount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_details` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_record` text COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `admin_comments` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `project_description` text COLLATE utf8_unicode_ci NOT NULL,
  `project_from_date` date NOT NULL,
  `project_to_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionbank`
--

CREATE TABLE `questionbank` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` bigint(20) UNSIGNED NOT NULL,
  `question_tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `question_type` enum('radio','checkbox','descriptive','blanks','match','para','video','audio') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'radio',
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `question_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `question_file_is_url` tinyint(1) NOT NULL DEFAULT '0',
  `total_answers` int(10) UNSIGNED NOT NULL,
  `answers` text COLLATE utf8_unicode_ci NOT NULL,
  `total_correct_answers` int(50) NOT NULL DEFAULT '1',
  `correct_answers` text COLLATE utf8_unicode_ci NOT NULL,
  `marks` int(10) UNSIGNED NOT NULL,
  `time_to_spend` int(11) NOT NULL DEFAULT '1',
  `difficulty_level` enum('easy','medium','hard') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'easy',
  `hint` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `explanation` text COLLATE utf8_unicode_ci NOT NULL,
  `explanation_file` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `question_l2` text COLLATE utf8_unicode_ci,
  `explanation_l2` text COLLATE utf8_unicode_ci,
  `user_submitted` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionbank_quizzes`
--

CREATE TABLE `questionbank_quizzes` (
  `id` int(10) UNSIGNED NOT NULL,
  `questionbank_id` bigint(20) UNSIGNED NOT NULL,
  `quize_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `marks` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizcategories`
--

CREATE TABLE `quizcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizresults`
--

CREATE TABLE `quizresults` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `marks_obtained` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `negative_marks` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_marks` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `percentage` decimal(10,2) NOT NULL,
  `exam_status` enum('pass','fail','pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `answers` text COLLATE utf8_unicode_ci NOT NULL,
  `subject_analysis` text COLLATE utf8_unicode_ci,
  `correct_answer_questions` text COLLATE utf8_unicode_ci,
  `wrong_answer_questions` text COLLATE utf8_unicode_ci,
  `not_answered_questions` text COLLATE utf8_unicode_ci,
  `time_spent_correct_answer_questions` text COLLATE utf8_unicode_ci NOT NULL,
  `time_spent_wrong_answer_questions` text COLLATE utf8_unicode_ci NOT NULL,
  `time_spent_not_answered_questions` text COLLATE utf8_unicode_ci NOT NULL,
  `percentage_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade_points` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(11) DEFAULT NULL,
  `total_users_for_this_quiz` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dueration` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `cost` decimal(10,2) DEFAULT NULL,
  `validity` int(11) NOT NULL,
  `total_marks` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `having_negative_mark` tinyint(1) NOT NULL DEFAULT '0',
  `negative_mark` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pass_percentage` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publish_results_immediately` tinyint(4) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `total_questions` int(50) NOT NULL,
  `instructions_page_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `record_updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `show_in_front` tinyint(2) NOT NULL DEFAULT '0',
  `exam_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NSNT',
  `section_data` text COLLATE utf8_unicode_ci,
  `has_language` tinyint(2) NOT NULL DEFAULT '0',
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_popular` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` bigint(20) NOT NULL,
  `quiz_id` int(10) DEFAULT NULL,
  `quiz_result_id` int(10) DEFAULT NULL,
  `student_id` int(10) DEFAULT NULL,
  `questions_data` longtext,
  `subjects_data` longtext,
  `is_exam_started` tinyint(2) NOT NULL DEFAULT '1',
  `is_exam_completed` tinyint(2) NOT NULL DEFAULT '0',
  `current_state` longtext,
  `current_hour` int(11) DEFAULT NULL,
  `current_minute` int(11) DEFAULT NULL,
  `current_second` int(11) DEFAULT NULL,
  `current_question_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resumetemplates`
--

CREATE TABLE `resumetemplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `resume_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_default` enum('0','1') COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `resumetemplates`
--

INSERT INTO `resumetemplates` (`id`, `title`, `resume_key`, `status`, `is_default`, `image`, `created_at`, `updated_at`, `slug`) VALUES
(1, 'White Template', 'white_template', '1', '0', '1_white-template.jpeg', '2019-05-29 23:28:13', '2019-05-30 00:55:19', 'white-template-3'),
(2, 'Green Resume', 'green_template', '1', '1', '2_green-resume-1.jpeg', '2019-05-29 23:54:57', '2019-05-30 00:55:19', 'green-template-3'),
(6, 'Yellow Template', 'yellow_template', '1', '0', '6-yellow-template-3.jpeg', '2019-05-29 23:54:57', '2019-05-30 00:55:19', 'yellow-template-3');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'Owner', 'Owner of this account', '2016-06-08 03:32:59', '2016-06-08 03:32:59'),
(2, 'admin', 'Admin', 'Admin of this Account', '2016-06-08 03:33:19', '2016-06-08 03:33:19'),
(5, 'student', 'Student', 'Student User', '2016-06-08 04:01:54', '2016-06-08 04:01:54'),
(6, 'parent', 'Parent User', 'Parent Login', '2016-06-08 07:35:27', '2016-06-08 07:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `settings_data` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `key`, `slug`, `image`, `settings_data`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Email Settings', 'email_settings', 'email-settings', NULL, '{\"mail_driver\":{\"value\":\"smtp\",\"type\":\"select\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Driver\"},\"mail_host\":{\"value\":\"\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Mail Host\"},\"mail_port\":{\"value\":\"\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Mail Port no\"},\"mail_username\":{\"value\":\"\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Mail Username\"},\"mail_password\":{\"value\":\"\",\"type\":\"password\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Password\"},\"mail_encryption\":{\"value\":\"null\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Mail Encryption\"}}', 'Contains all the settings related to emails', '2016-08-28 23:55:26', '2018-04-04 15:12:10'),
(4, 'Paypal Settings', 'paypal', 'paypal', 'Zw7qp7b7lc2yCvM.png', '{\"email\":{\"value\":\"\",\"type\":\"email\",\"extra\":\"\",\"tool_tip\":\"Paypal Email\"},\"currency\":{\"value\":\"USD\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Default Currency\"},\"image\":{\"value\":\"fCStst6ekDhWzfL.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Image to display at Paypal payment gateway\"},\"account_type\":{\"value\":\"sandbox\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"sandbox\":\"Sandbox\",\"live\":\"Live\"}},\"tool_tip\":\"Account Type Development (sandbox)\\/ Production (live)\"}}', 'Contains paypal config details', '2016-09-08 03:38:30', '2018-04-04 15:10:59'),
(5, 'PayU Settings', 'payu', 'payu', NULL, '{\"payu_merchant_key\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"PayU Merchent Key\"},\"payu_salt\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"PayU Salt\"},\"payu_working_key\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"PayU Working Key\"},\"payu_testmode\":{\"value\":\"true\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"true\":\"Yes\",\"false\":\"No\"}},\"tool_tip\":\"Set PayU in Test Mode\"}}', 'Payu Settings', '2016-09-09 01:25:33', '2018-04-04 15:11:07'),
(6, 'Site Settings', 'site_settings', 'site-settings', NULL, '{\"site_title\":{\"value\":\"Menorah OES\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Site Title\"},\"site_logo\":{\"value\":\"48WbiBMQQX9NaTk.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Site Logo\"},\"site_address\":{\"value\":\"8929 Fremont Court \\r\\nMchenry, \\r\\nIL 60050\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Address\"},\"site_city\":{\"value\":\"Hyderabad\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"City\"},\"site_favicon\":{\"value\":\"Wg9dSY7az6WgXpO.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Favicon\"},\"site_state\":{\"value\":\"Telangana\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"State\"},\"site_country\":{\"value\":\"India\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Country\"},\"site_zipcode\":{\"value\":\"500018\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Postal Code\"},\"site_phone\":{\"value\":\"1234567891\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Phone\"},\"system_timezone\":{\"value\":\"Asia\\/Kolkata\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Refer http:\\/\\/php.net\\/manual\\/en\\/timezones.php\"},\"phone_number_expression\":{\"value\":\"\\/^\\\\d{10}$\\/\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Give regular expression for your phone no.\"},\"background_image\":{\"value\":\"Pe6AvaMsX3niANH.jpeg\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Background image at front end before login\"},\"currency_code\":{\"value\":\"$\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Enter currency symbol\"},\"facebook_login\":{\"value\":\"https:\\\\\\/\\\\\\/www.facebook.com\\\\\\/\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Face Book\"},\"google_plus_login\":{\"value\":\"https:\\\\\\/\\\\\\/plus.google.com\\\\\\/up\\\\\\/accounts\\\\\\/upgrade\\\\\\/?continue=https:\\\\\\/\\\\\\/plus.google.com\\\\\\/people\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Google Plus Login\"},\"exam_layout\":{\"value\":\"layout2\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"layout1\":\"Layout one\",\"layout2\":\"Layout two\"}},\"tool_tip\":\"Exam Layout\"}}', 'Here you can manage the title, logo, favicon and all general settings', '2016-09-29 06:46:54', '2018-04-04 07:43:19'),
(7, 'Seo Settings', 'seo_settings', 'seo-settings-1', NULL, '{\"meta_description\":{\"value\":\"Menorah Online Examination System\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Site Meta Description\"},\"meta_keywords\":{\"value\":\"Menorah Online Examination System\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Site Meta Keywords\"},\"google_analytics\":{\"value\":\"<!-- Google Analytics -->\\r\\n<script>\\r\\n(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){\\r\\n(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\\r\\nm=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\\r\\n})(window,document,\'script\',\'https:\\/\\/www.google-analytics.com\\/analytics.js\',\'ga\');\\r\\n\\r\\nga(\'create\', \'UA-XXXXX-Y\', \'auto\');\\r\\nga(\'send\', \'pageview\');\\r\\n<\\/script>\\r\\n<!-- End Google Analytics -->\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Update your google analytics code\"}}', 'Contains all SEO settings', '2016-09-30 13:33:46', '2016-11-24 05:53:39'),
(8, 'Payment Gateways', 'payment_gateways', 'payment-gateways', NULL, '{\"offline_payment_information\":{\"value\":\"1) Pay the amount through DD\\/Check\\/Deposit in favor of Admin, Academia, India <br\\/>\\r\\n2) Update the Payment information in the below box <br\\/>\\r\\n3) Admin will validate the payment details and update your subscription <br\\/>\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Information related to offline payment\"}}', 'Contains all list of payment gateways in the system and the status of availability ', '2016-10-02 09:48:19', '2017-01-23 11:17:28'),
(9, 'Modules Management', 'module', 'module', NULL, '{\"payu\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable PayU Payment Gateway\"},\"paypal\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Paypal Payment Gateway\"},\"razorpay\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Razorpay Payment Gateway\"},\"messaging\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Messaging Module\"},\"parent\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Parent Module\"},\"coupons\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Coupons Module\"},\"offline_payment\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Offline Payment Option\"},\"certificate\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Certificate Module\"},\"show_foreign_key_constraint\":{\"value\":0,\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"sho foreign key constraint message at delete operation\"},\"facebook_login\":{\"value\":0,\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Facebook Login\"},\"google_plus_login\":{\"value\":0,\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Google+ Login\"}}', 'You can enable or disable modules in the system', '2016-10-12 11:36:22', '2018-04-04 14:46:11'),
(11, 'Certificate', 'certificate', 'certificate', NULL, '{\"logo\":{\"value\":\"BHJ3ILUWVH4uPH9.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Header logo of certificate\"},\"content\":{\"value\":\"<span style=\\\"font-size:18px; font-style:italic;\\\">This is to certify that <b style=\\\"padding:0 10px; font-size:22px;\\\">{{$username}}<\\/b> Lorem Ipsum is simply dummy text <b style=\\\"padding:0 10px; font-size:22px;\\\">{{$course_name}}<\\/b> of the printing with score of <b style=\\\"padding:0 10px; font-size:22px;\\\">{{$marks}}<\\/b> and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took<\\/span>\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Content for the certificate\"},\"left_sign_image\":{\"value\":\"5Ci7Olem7IgiGnv.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Left Sign Image\"},\"right_sign_image\":{\"value\":\"5ANb26yLV5pNSfc.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Right Sign Image\"},\"left_sign_name\":{\"value\":\"Kiran\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Left Sign Name\"},\"right_sign_name\":{\"value\":\"Kumar\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Right Sign Name\"},\"left_sign_designation\":{\"value\":\"Course Teacher\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Left Sign Designation\"},\"right_sign_designation\":{\"value\":\"Admin\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Right Sign Designation\"},\"watermark_image\":{\"value\":\"Lotdj6RBOtuf5Y4.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Water Mark Image for transparent background\"},\"bottom_middle_logo\":{\"value\":\"RY8Vk1iWBjkQ9Yb.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Bottom middle logo\"}}', 'This Module contains the settings for Certificate', '2016-10-13 06:57:36', '2016-11-24 05:47:39'),
(12, 'Social Logins', 'social_logins', 'social-logins', NULL, '{\"facebook_client_id\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Facebook Client ID\"},\"facebook_client_secret\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Facebook Client Secret\"},\"facebook_redirect_url\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"It should be http (or) https:\\/\\/yourservername\\/auth\\/google\\/callback\"},\"google_client_id\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Google Plus Client ID\"},\"Google_client_secret\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Google Client Secret Key\"},\"google_redirect_url\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"http (or) https:\\/\\/yourserver.com\\/auth\\/google\\/callback\"}}', 'Add/Update Settings for Social Logins (Facebook and Google plus)', '2016-10-28 10:56:37', '2018-04-04 15:11:44'),
(13, 'Messaging System', 'messaging_system', 'messaging-system', NULL, '{\"messaging_system_for\":{\"value\":\"all\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"all\":\"All\",\"admin\":\"Admin and Student\"}},\"tool_tip\":\"To whome you want to use this system\"}}', '', '2016-10-29 16:33:37', '2016-10-31 13:41:19'),
(14, 'SMS Settings', 'sms_settings', 'sms-settings', NULL, '{\"sms_driver\":{\"value\":\"nexmo\",\"type\":\"select\",\"extra\":{\"total_options\":\"3\",\"options\":{\"nexmo\":\"NEXMO\",\"plivo\":\"PLIVO\",\"twilio\":\"TWILIO\"}},\"tool_tip\":\"Select SMS driver\"},\"nexmo_key\":{\"value\":\"NEXMO_KEY\",\"type\":\"text\",\"extra\":{\"total_options\":\"3\",\"options\":{\"nexmo\":\"NEXMO\",\"plivo\":\"PLIVO\",\"twilio\":\"TWILIO\"}},\"tool_tip\":\"Nexmo API Key\"},\"nexmo_secret\":{\"value\":\"NEXMO_SECRET\",\"type\":\"text\",\"extra\":{\"total_options\":\"3\",\"options\":{\"nexmo\":\"NEXMO\",\"plivo\":\"PLIVO\",\"twilio\":\"TWILIO\"}},\"tool_tip\":\"Enter Nexmo Secret Key\"},\"plivo_auth_id\":{\"value\":\"PLIVO_AUTH_ID\",\"type\":\"text\",\"extra\":{\"total_options\":\"3\",\"options\":{\"nexmo\":\"NEXMO\",\"plivo\":\"PLIVO\",\"twilio\":\"TWILIO\"}},\"tool_tip\":\"Enter Plivo Auth ID\"},\"plivo_auth_token\":{\"value\":\"PLIVO_AUTH_TOKEN\",\"type\":\"text\",\"extra\":{\"total_options\":\"3\",\"options\":{\"nexmo\":\"NEXMO\",\"plivo\":\"PLIVO\",\"twilio\":\"TWILIO\"}},\"tool_tip\":\"Plivo Auth Token\"},\"twilio_sid\":{\"type\":\"text\",\"value\":\"TWILIO_SID\",\"extra\":\"\",\"tool_tip\":\"Twilio SID\"},\"twilio_token\":{\"type\":\"text\",\"value\":\"TWILIO_TOKEN\",\"extra\":\"\",\"tool_tip\":\"Twilio Token\"}}', 'Contains settings for SMS', '2017-01-25 05:10:09', '2017-01-25 05:30:16'),
(23, 'Site Pages', 'site_pages', 'site-pages-11', NULL, '{\r\n	\"privacy-policy\": {\r\n		\"value\": \"   <section class=\\\"terms-conditon\\\">\\r\\n    <div class=\\\"container\\\">\\r\\n        <div class=\\\"row\\\">\\r\\n            <div class=\\\"col-md-12 mps-common\\\">\\r\\n                <h1 class=\\\"text-center\\\">Privacy and Policy<\\/h1>\\r\\n                <div class=\\\"row\\\">\\r\\n                    <div class=\\\"col-md-12 mps-common\\\">\\r\\n                        <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n                        <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n                        <p>A more sophisticated version of this document is available on website: <a href=\\\"javascript:void(0);\\\">privacy and cookies policy.<\\/a><\\/p>\\r\\n                        \\r\\n                    <\\/div>\\r\\n                    <div class=\\\"col-md-12 mps-common\\\">\\r\\n                        <h4>More Information About Privacy Policies:<\\/h4>\\r\\n                        <p><i class=\\\"fa fa-check-square-o\\\" aria-hidden=\\\"true\\\"><\\/i> categories of personal information collected by the website<\\/p>\\r\\n                        <p><i class=\\\"fa fa-check-square-o\\\" aria-hidden=\\\"true\\\"><\\/i> categories of personal information collected by the website<\\/p>\\r\\n                        <p><i class=\\\"fa fa-check-square-o\\\" aria-hidden=\\\"true\\\"><\\/i> categories of personal information collected by the website<\\/p>\\r\\n                        <p><i class=\\\"fa fa-check-square-o\\\" aria-hidden=\\\"true\\\"><\\/i> categories of personal information collected by the website<\\/p>\\r\\n                        <p><i class=\\\"fa fa-check-square-o\\\" aria-hidden=\\\"true\\\"><\\/i> categories of personal information collected by the website<\\/p>\\r\\n                        <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n                        <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n                        \\r\\n                        \\r\\n                       <!-- <p class=\\\"dual-btns\\\"> <a href=\\\"#\\\" class=\\\"btn-demo\\\">Download<\\/a> <a href=\\\"#\\\" class=\\\"btn-buy\\\">Get Licence<\\/a> <\\/p>-->\\r\\n                        <p><strong>Note:<\\/strong>If you use the free privacy policy, you must retain the credit for OES. However, if you purchase the equivalent document on website, you will get access to a copy of the document that omits the credit.<\\/p>\\r\\n                        \\r\\n                    <\\/div>\\r\\n                <\\/div>\\r\\n            <\\/div>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n<\\/section>\",\r\n		\"type\": \"textarea\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Privacy Policy Page\"\r\n	},\r\n	\"terms-conditions\": {\r\n		\"value\": \" <section class=\\\"terms-conditon\\\">\\r\\n      <div class=\\\"container\\\">\\r\\n        <div class=\\\"row\\\">\\r\\n           <div class=\\\"col-md-12 mps-common\\\">\\r\\n              <h1 class=\\\"text-center\\\">Terms and Conditions<\\/h1>  \\r\\n                <div class=\\\"row\\\">\\r\\n                   <div class=\\\"col-md-12 mps-common\\\">\\r\\n                        \\r\\n                    <h4>General<\\/h4>\\r\\n                    <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n                    <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\"<\\/p>\\r\\n                \\r\\n               <\\/div>\\r\\n               \\r\\n               <div class=\\\"col-md-12 mps-common\\\">\\r\\n                        \\r\\n                    <h4>Services<\\/h4>\\r\\n                    <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n                    <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\"<\\/p>\\r\\n                \\r\\n               <\\/div>\\r\\n               \\r\\n               \\r\\n               <div class=\\\"col-md-12 mps-common\\\">\\r\\n                        \\r\\n                    <h4>Service Fees \\/ Payments \\/ Invoices<\\/h4>\\r\\n                    <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n                    <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\"<\\/p>\\r\\n                \\r\\n               <\\/div>\\r\\n               \\r\\n               <div class=\\\"col-md-12 mps-common\\\">\\r\\n                        \\r\\n                    <h4>Termination \\/ Plan Change \\/ Refund Policy<\\/h4>\\r\\n                    <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n                    <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\"<\\/p>\\r\\n                \\r\\n               <\\/div>\\r\\n               \\r\\n               <div class=\\\"col-md-12 mps-common\\\">\\r\\n                        \\r\\n                    <h4>Subscriber Responsibility<\\/h4>\\r\\n                    <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n                    <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\"<\\/p>\\r\\n                \\r\\n               <\\/div>\\r\\n               \\r\\n               <div class=\\\"col-md-12 mps-common\\\">\\r\\n                        \\r\\n                    <h4>Entire Agreement<\\/h4>\\r\\n                    <p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n                    <p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\"<\\/p>\\r\\n                \\r\\n               <\\/div>\\r\\n            <\\/div>\\r\\n          <\\/div>      \\r\\n        <\\/div>      \\r\\n      <\\/div>\\r\\n    <\\/section>\",\r\n		\"type\": \"textarea\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Terms & Conditions page\"\r\n	},\r\n\r\n	\"copyrights\": {\r\n		\"value\": \" Copyright \\u00a9 2009 - 2017 Conquerors Software Technologies Pvt. Ltd. All Rights Reserved\",\r\n		\"type\": \"text\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Copy Rights Information\"\r\n	}\r\n}', 'This setting holds the static pages in the site', '2017-12-18 06:53:10', '2018-02-04 12:38:43'),
(24, 'Recaptcha Settings', 'recaptcha_settings', 'recaptcha-settings', NULL, '{\"enable_rechaptcha\":{\"value\":\"no\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"no\":\"No\",\"yes\":\"Yes\"}},\"tool_tip\":\"Make yes to active reChaptcha while in login and registration\"},\"nocaptcha_secret\":{\"value\":\"\",\"type\":\"text\",\"extra\":{\"total_options\":\"2\",\"options\":{\"no\":\"No\",\"yes\":\"Yes\"}},\"tool_tip\":\"Enter Your Rechaptcha Secret Key\"},\"nocaptcha_sitekey\":{\"value\":\"\",\"type\":\"text\",\"extra\":{\"total_options\":\"2\",\"options\":{\"no\":\"No\",\"yes\":\"Yes\"}},\"tool_tip\":\"Enter Your Rechaptcha Site Key\"}}', 'Plese update your Rechaptcha Site Key and SECRET Key.', NULL, '2018-04-04 15:10:36'),
(25, 'Razorpay Settings', 'razorpay_settings', 'razorpay-settings', NULL, '{\"razorpay_apikey\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Razorpay API Key\"},\"razorpay_secret\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Razorpay Secret Key\"}}', 'Razorpay API details', NULL, '2018-04-04 15:10:47'),
(26, 'Mobile Payment Gateways', 'mobile_gateways', 'mobile-gateways', NULL, '{\"payu\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable PayU Payment Gateway\"},\"paypal\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Paypal Payment Gateway\"},\"razorpay\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Razorpay Module\"},\"offline_payment\":{\"value\":\"1\",\"type\":\"checkbox\",\"extra\":\"\",\"tool_tip\":\"Enable\\/Disable Offline Payment Option\"}}', 'You can enable or disable payment gateways for mobile app\r\n', '2019-05-31 10:11:30', '2019-05-31 10:11:30'),
(27, 'Push Notification Settings', 'push_notification', 'push-notification', NULL, '{\"fcm_server_key\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"FCM Server Key\"},\"fcm_sender_id\":{\"value\":\"\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"FCM Sender ID\"}}', 'Add/Update Settings for FCM Notifications', '2019-05-31 10:11:30', '2019-05-31 10:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `site_user_subscription`
--

CREATE TABLE `site_user_subscription` (
  `id` bigint(20) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subject_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `maximum_marks` int(11) NOT NULL,
  `pass_marks` int(11) NOT NULL,
  `is_lab` tinyint(4) NOT NULL DEFAULT '0',
  `is_elective_type` tinyint(4) NOT NULL DEFAULT '0',
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_plan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `technicalskills`
--

CREATE TABLE `technicalskills` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `skill_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `skills_known` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `slug` varchar(250) NOT NULL,
  `theme_title_key` varchar(250) NOT NULL,
  `settings_data` text NOT NULL,
  `description` text,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `theme_color` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `title`, `slug`, `theme_title_key`, `settings_data`, `description`, `is_active`, `theme_color`, `created_at`, `updated_at`) VALUES
(1, 'Default', 'default', 'default', '{\"banner_title\":{\"value\":\" Multi Purpose Menorah OES\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Home Page title\"},\"banner_sub_title\":{\"value\":\"We make your success\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Home Page Subtitle\"},\"home_page_facebook_link\":{\"value\":\"https:\\/\\/www.facebook.com\\/\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Home Page Title\"},\"home_page_twitter_link\":{\"value\":\"https:\\/\\/twitter.com\\/login?lang=en\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Home Page Title\"},\"home_page_googleplus_link\":{\"value\":\"https:\\/\\/plus.google.com\\/discover\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Home Page Title\"},\"copyrights\":{\"value\":\" Copyright \\u00a9 2009 - 2018 Test Software Technologies Pvt. Ltd. All Rights Reserved\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Copy Rights Information\"},\"privacy-policy\":{\"value\":\"<h1>Privacy and Policy<\\/h1>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>A more sophisticated version of this document is available on website: <a href=\\\"javascript:void(0);\\\">privacy and cookies policy.<\\/a><\\/p>\\r\\n\\r\\n<p>More Information About Privacy Policies:<\\/p>\\r\\n\\r\\n<p>categories of personal information collected by the website<\\/p>\\r\\n\\r\\n<p>categories of personal information collected by the website<\\/p>\\r\\n\\r\\n<p>categories of personal information collected by the website<\\/p>\\r\\n\\r\\n<p>categories of personal information collected by the website<\\/p>\\r\\n\\r\\n<p>categories of personal information collected by the website<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n<!-- <p class=\\\"dual-btns\\\"> <a href=\\\"#\\\" class=\\\"btn-demo\\\">Download<\\/a> <a href=\\\"#\\\" class=\\\"btn-buy\\\">Get Licence<\\/a> <\\/p>-->\\r\\n\\r\\n<p><strong>Note:<\\/strong>If you use the free privacy policy, you must retain the credit for OES. However, if you purchase the equivalent document on website, you will get access to a copy of the document that omits the credit.<\\/p>\\r\\n\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Privacy Policy Page\"},\"terms-conditions\":{\"value\":\"<h1>Terms and Conditions<\\/h1>\\r\\n\\r\\n<p>General<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;<\\/p>\\r\\n\\r\\n<p>Services<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;<\\/p>\\r\\n\\r\\n<p>Service Fees \\/ Payments \\/ Invoices<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;<\\/p>\\r\\n\\r\\n<p>Termination \\/ Plan Change \\/ Refund Policy<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;<\\/p>\\r\\n\\r\\n<p>Subscriber Responsibility<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;<\\/p>\\r\\n\\r\\n<p>Entire Agreement<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;<\\/p>\\r\\n\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Terms & Conditions page\"}}', NULL, 0, NULL, '2018-03-24 00:00:00', '2018-04-04 10:11:06'),
(2, 'Theme One', 'theme_one', 'themeone', '{\r\n	\"home_page_title\": {\r\n		\"value\": \"Menorah OES\",\r\n		\"type\": \"text\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Home Page Title\"\r\n	},\r\n	\"home_page_link\": {\r\n		\"value\": \"\",\r\n		\"type\": \"text\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Home Page Link\"\r\n	},\r\n	\"home_page_image\": {\r\n		\"value\": \"MxpUqSM4H0AIo2X.jpg\",\r\n		\"type\": \"file\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Background image at front end before login\"\r\n	},\r\n	\"home_page_background_image\": {\r\n		\"value\": \"qfOuNvGvWX5BzJG.jpg\",\r\n		\"type\": \"file\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Background image at front end before login\"\r\n	},\r\n	\"home_page_facebook_link\": {\r\n		\"value\": \"https:\\/\\/www.facebook.com\\/\",\r\n		\"type\": \"text\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Home Page Title\"\r\n	},\r\n	\"home_page_twitter_link\": {\r\n		\"value\": \"https:\\/\\/twitter.com\\/login?lang=en\",\r\n		\"type\": \"text\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Home Page Title\"\r\n	},\r\n	\"home_page_googleplus_link\": {\r\n		\"value\": \"https:\\/\\/plus.google.com\\/discover\",\r\n		\"type\": \"text\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Home Page Title\"\r\n	},\r\n	\"copyrights\": {\r\n		\"value\": \" Copyright \\u00a9 2009 - 2018  Test Software Technologies Pvt. Ltd. All Rights Reserved\",\r\n		\"type\": \"text\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Copy Rights Information\"\r\n	},\r\n	\"courses\": {\r\n		\"value\": \"<p>Aerospace Engineering<\\/p>\\r\\n\\r\\n<p>Computer Science Engineering<\\/p>\\r\\n\\r\\n<p>Mechanical Engineering<\\/p>\\r\\n\\r\\n<p>Electrical Engineering<\\/p>\\r\\n\\r\\n<p>Civil Engineering<\\/p>\\r\\n\\r\\n<p>Finance<\\/p>\\r\\n\\r\\n<p>Human Resource Management<\\/p>\\r\\n\\r\\n<p>Sales and Marketing<\\/p>\\r\\n\\r\\n<p>Operations Management<\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\",\r\n		\"type\": \"textarea\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Courses\"\r\n	},\r\n	\"pattren\": {\r\n		\"value\": \"<p>Unlike CBSE&#39;s old pattern of only one test at the end of the academic year, the CCE conducts several. There are two different types of tests. Namely, the <em>formative<\\/em> and the <em>summative<\\/em>. Formative tests will comprise the student&#39;s work at class and home, the student&#39;s performance in oral tests and quizzes and the quality of the projects or assignments submitted by the child. Formative tests will be conducted four times in an academic session, and they will carry a 40% weightage for the aggregate. In some schools, an additional written test is conducted instead of multiple oral tests. However, at least one oral test is conducted.<\\/p>\\r\\n\\r\\n<p>The summative assessment is a three-hour long written test conducted twice a year. The first summative or <em>Summative Assessment 1<\\/em> (SA-1) will be conducted after the first two formatives are completed. The second (SA-2) will be conducted after the next two formatives. Each summative will carry a 30% weightage and both together will carry a 60% weightage for the aggregate. The summative assessment will be conducted by the schools itself. However, the question papers will be partially prepared by the CBSE and evaluation of the answer sheets is also strictly monitored by the CBSE. Once completed, the syllabus of one summative <em>will not<\\/em> be repeated in the next. A student will have to concentrate on totally new topics for the next summative<\\/p>\\r\\n\",\r\n		\"type\": \"textarea\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"pattren\"\r\n	},\r\n	\"pricing\": {\r\n		\"value\": \"\",\r\n		\"type\": \"textarea\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"pricing\"\r\n	},\r\n	\"syllabus\": {\r\n		\"value\": \"<p>The syllabus for each of the papers can be found by clicking on the papers (subject) below. Refer table 4.2 in the Information Brochure to know what sections appear in each paper, especially in XE and XL.<\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<table align=\\\"center\\\" border=\\\"1\\\" cellpadding=\\\"10\\\" cellspacing=\\\"0\\\" style=\\\"width:60%\\\">\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\"><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/General-Aptitude.pdf\\\" target=\\\"_blank\\\">General Aptitude (GA) : Common in all papers<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/AE-Aerospace-Engineering.pdf\\\" target=\\\"_blank\\\">AE: Aerospace Engineering<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/PH_Physics.pdf\\\" target=\\\"_blank\\\">PH: Physics<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/AG_Agricultural-Engineering.pdf\\\" target=\\\"_blank\\\">AG: Agricultural Engineering<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/PI_Production-And-Industrial-Engineering.pdf\\\" target=\\\"_blank\\\">PI: Production and Industrial Engineering<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/AR_Architecture-and-Planning.pdf\\\" target=\\\"_blank\\\">AR: Architecture and Planning<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/TF_Textile_Engineering_and_Fibre_Science.pdf\\\" target=\\\"_blank\\\">TF: Textile Engineering and Fibre Science<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/BT_Biotechnology.pdf\\\" target=\\\"_blank\\\">BT: Biotechnology<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XE_A-Engineering-Mathematics.pdf\\\" target=\\\"_blank\\\">XE -A: Engineering Mathematics<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/CE_Civil-Engineering.pdf\\\" target=\\\"_blank\\\">CE: Civil Engineering<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XE_B_Fluid-Mechanics.pdf\\\" target=\\\"_blank\\\">XE-B: Fluid Mechanics<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/CH_Chemical-Engineering.pdf\\\" target=\\\"_blank\\\">CH: Chemical Engineering<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XE_C_Materials-Science.pdf\\\" target=\\\"_blank\\\">XE-C: Materials Science<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/CS_Computer-Science-and-Information-Technology.pdf\\\" target=\\\"_blank\\\">CS: Computer Sc. and Information Technology<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XE_D_Solid-Mechanics.pdf\\\" target=\\\"_blank\\\">XE-D: Solid Mechanics<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/CY_Chemistry.pdf\\\" target=\\\"_blank\\\">CY: Chemistry<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XE_E_Thermodynamics.pdf\\\" target=\\\"_blank\\\">XE-E: Thermodynamics<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/EC_Electronics-and-Communications_Engineering.pdf\\\" target=\\\"_blank\\\">EC: Electronics and Communication Engg.<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XE_F_Polymer-Science-and-Engineering.pdf\\\" target=\\\"_blank\\\">XE-F: Polymer Science and Engineering<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/EE_Electrical-Engineering.pdf\\\" target=\\\"_blank\\\">EE: Electrical Engineering<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XE_G_Food-Technology.pdf\\\" target=\\\"_blank\\\">XE &ndash; G: Food Technology<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/EY_Ecology-and-Evolution.pdf\\\" target=\\\"_blank\\\">EY: Ecology and Evolution<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XE_H_Atmospheric_OceSc.pdf\\\" target=\\\"_blank\\\">XE &ndash; H: Atmospheric and Oceanic Sciences<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/GG_Geology-and-Geophysics.pdf\\\" target=\\\"_blank\\\">GG: Geology and Geophysics<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XL_P_Chemistry.pdf\\\" target=\\\"_blank\\\">XL &ndash; P: Chemistry<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/IN_Instrumentation-Engineering.pdf\\\" target=\\\"_blank\\\">IN: Instrumentation Engineering<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XL_Q_Biochemistry.pdf\\\" target=\\\"_blank\\\">XL-Q: Biochemistry<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/MA_Mathematics.pdf\\\" target=\\\"_blank\\\">MA: Mathematics<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XL_R_Botany.pdf\\\" target=\\\"_blank\\\">XL-R: Botany<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/ME_Mechanical-Engineering.pdf\\\" target=\\\"_blank\\\">ME: Mechanical Engineering<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XL_S_Microbiology.pdf\\\" target=\\\"_blank\\\">XL &ndash; S: Microbiology<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/MN_Mining-Engineering.pdf\\\" target=\\\"_blank\\\">MN: Mining Engineering<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XL_T_Zoology.pdf\\\" target=\\\"_blank\\\">XL &ndash; T: Zoology<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/MT_Metallurgical-Engineering.pdf\\\" target=\\\"_blank\\\">MT: Metallurgical Engineering<\\/a><\\/td>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/XL_U_Food-Technology.pdf\\\" target=\\\"_blank\\\">XL &ndash; U: Food Technology<\\/a><\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><a href=\\\"http:\\/\\/www.gate.iitg.ac.in\\/Syllabi\\/PE_Petroleum_Engineering.pdf\\\" target=\\\"_blank\\\">PE: Petroleum Engineering<\\/a><\\/td>\\r\\n\\t\\t\\t<td>&nbsp;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\",\r\n		\"type\": \"textarea\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Syllabus\"\r\n	},\r\n	\"about-us\": {\r\n		\"value\": \"<p><strong>Lorem Ipsum<\\/strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<\\/p>\\r\\n\",\r\n		\"type\": \"textarea\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"About Us Page\"\r\n	},\r\n	\"privacy-policy\": {\r\n		\"value\": \"<h1>Privacy and Policy<\\/h1>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>A more sophisticated version of this document is available on website: <a href=\\\"javascript:void(0);\\\">privacy and cookies policy.<\\/a><\\/p>\\r\\n\\r\\n<p>More Information About Privacy Policies:<\\/p>\\r\\n\\r\\n<p>categories of personal information collected by the website<\\/p>\\r\\n\\r\\n<p>categories of personal information collected by the website<\\/p>\\r\\n\\r\\n<p>categories of personal information collected by the website<\\/p>\\r\\n\\r\\n<p>categories of personal information collected by the website<\\/p>\\r\\n\\r\\n<p>categories of personal information collected by the website<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n<!-- <p class=\\\"dual-btns\\\"> <a href=\\\"#\\\" class=\\\"btn-demo\\\">Download<\\/a> <a href=\\\"#\\\" class=\\\"btn-buy\\\">Get Licence<\\/a> <\\/p>-->\\r\\n\\r\\n<p><strong>Note:<\\/strong>If you use the free privacy policy, you must retain the credit for OES. However, if you purchase the equivalent document on website, you will get access to a copy of the document that omits the credit.<\\/p>\\r\\n\",\r\n		\"type\": \"textarea\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Privacy Policy Page\"\r\n	},\r\n	\"terms-conditions\": {\r\n		\"value\": \"<h1>Terms and Conditions<\\/h1>\\r\\n\\r\\n<p>General<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;<\\/p>\\r\\n\\r\\n<p>Services<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;<\\/p>\\r\\n\\r\\n<p>Service Fees \\/ Payments \\/ Invoices<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;<\\/p>\\r\\n\\r\\n<p>Termination \\/ Plan Change \\/ Refund Policy<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;<\\/p>\\r\\n\\r\\n<p>Subscriber Responsibility<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;<\\/p>\\r\\n\\r\\n<p>Entire Agreement<\\/p>\\r\\n\\r\\n<p>only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum<\\/p>\\r\\n\\r\\n<p>as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<\\/p>\\r\\n\\r\\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;<\\/p>\\r\\n\",\r\n		\"type\": \"textarea\",\r\n		\"extra\": \"\",\r\n		\"tool_tip\": \"Terms & Conditions page\"\r\n	},\r\n	\"theme_color\": {\r\n		\"value\": \"blueheader\",\r\n		\"type\": \"select\",\r\n		\"extra\": {\r\n			\"total_options\": \"5\",\r\n			\"options\": {\r\n				\"blueheader\": \"Blue Header\",\r\n				\"bluenavbar\": \"Blue Navigation Bar\",\r\n				\"darkheader\": \"Dark Header\",\r\n				\"darktheme\": \"Dark Theme\",\r\n				\"whitecolor\": \"default\"\r\n			}\r\n		},\r\n		\"tool_tip\": \"Block user if user canot reach minimum total CPD points\"\r\n	}\r\n}', NULL, 1, NULL, '2018-03-24 00:00:00', '2018-04-04 10:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `topic_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `total_attempted`
--

CREATE TABLE `total_attempted` (
  `id` int(10) UNSIGNED NOT NULL,
  `total_attempted` int(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `login_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `role_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `stripe_active` tinyint(1) NOT NULL DEFAULT '0',
  `stripe_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_plan` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_brand` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `subscription_ends_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `college_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `college_place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_of_interest` text COLLATE utf8_unicode_ci,
  `subject_taught` text COLLATE utf8_unicode_ci,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `marital_status` enum('Married','Unmarried') COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linguistic_ability` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `present_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personal_strength` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roll_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_id` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `career_objective` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `declaration` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workexperience`
--

CREATE TABLE `workexperience` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `work_experience` text COLLATE utf8_unicode_ci,
  `from_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicprofiles`
--
ALTER TABLE `academicprofiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `couponcodes`
--
ALTER TABLE `couponcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couponcodes_usage`
--
ALTER TABLE `couponcodes_usage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examlanguages`
--
ALTER TABLE `examlanguages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examseries`
--
ALTER TABLE `examseries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `examseries_data`
--
ALTER TABLE `examseries_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examseries_id` (`examseries_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `examtoppers`
--
ALTER TABLE `examtoppers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `quiz_result_id` (`quiz_result_id`),
  ADD KEY `quiz_id_2` (`quiz_id`),
  ADD KEY `quiz_result_id_2` (`quiz_result_id`);

--
-- Indexes for table `examtypes`
--
ALTER TABLE `examtypes`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `faqcategories`
--
ALTER TABLE `faqcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_category_id_foreign` (`category_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_group_unique` (`group`);

--
-- Indexes for table `instructions`
--
ALTER TABLE `instructions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `lmscategories`
--
ALTER TABLE `lmscategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lmscategories_slug_unique` (`slug`);

--
-- Indexes for table `lmscontents`
--
ALTER TABLE `lmscontents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lmscontents_slug_unique` (`slug`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `lmsseries`
--
ALTER TABLE `lmsseries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lms_category_id` (`lms_category_id`);

--
-- Indexes for table `lmsseries_data`
--
ALTER TABLE `lmsseries_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lmsseries_id` (`lmsseries_id`),
  ADD KEY `lmscontent_id` (`lmscontent_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messenger_participants`
--
ALTER TABLE `messenger_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messenger_threads`
--
ALTER TABLE `messenger_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionbank`
--
ALTER TABLE `questionbank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `questionbank_quizzes`
--
ALTER TABLE `questionbank_quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionbank_quizzes_questionbank_id_foreign` (`questionbank_id`),
  ADD KEY `quize_id` (`quize_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `quizcategories`
--
ALTER TABLE `quizcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quizcategories_slug_unique` (`slug`);

--
-- Indexes for table `quizresults`
--
ALTER TABLE `quizresults`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quizzes_slug_unique` (`slug`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `instructions_page_id` (`instructions_page_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resumetemplates`
--
ALTER TABLE `resumetemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`),
  ADD UNIQUE KEY `settings_slug_unique` (`slug`);

--
-- Indexes for table `site_user_subscription`
--
ALTER TABLE `site_user_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technicalskills`
--
ALTER TABLE `technicalskills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `total_attempted`
--
ALTER TABLE `total_attempted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `workexperience`
--
ALTER TABLE `workexperience`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicprofiles`
--
ALTER TABLE `academicprofiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `couponcodes`
--
ALTER TABLE `couponcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `couponcodes_usage`
--
ALTER TABLE `couponcodes_usage`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `examlanguages`
--
ALTER TABLE `examlanguages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `examseries`
--
ALTER TABLE `examseries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `examseries_data`
--
ALTER TABLE `examseries_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `examtoppers`
--
ALTER TABLE `examtoppers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faqcategories`
--
ALTER TABLE `faqcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `lmscategories`
--
ALTER TABLE `lmscategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lmscontents`
--
ALTER TABLE `lmscontents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lmsseries`
--
ALTER TABLE `lmsseries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lmsseries_data`
--
ALTER TABLE `lmsseries_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messenger_participants`
--
ALTER TABLE `messenger_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messenger_threads`
--
ALTER TABLE `messenger_threads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questionbank`
--
ALTER TABLE `questionbank`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questionbank_quizzes`
--
ALTER TABLE `questionbank_quizzes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizcategories`
--
ALTER TABLE `quizcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizresults`
--
ALTER TABLE `quizresults`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resumetemplates`
--
ALTER TABLE `resumetemplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `site_user_subscription`
--
ALTER TABLE `site_user_subscription`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `technicalskills`
--
ALTER TABLE `technicalskills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `total_attempted`
--
ALTER TABLE `total_attempted`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `workexperience`
--
ALTER TABLE `workexperience`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `questionbank` (`id`);

--
-- Constraints for table `couponcodes_usage`
--
ALTER TABLE `couponcodes_usage`
  ADD CONSTRAINT `couponcodes_usage_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `couponcodes_usage_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `couponcodes` (`id`);

--
-- Constraints for table `examseries`
--
ALTER TABLE `examseries`
  ADD CONSTRAINT `examseries_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `quizcategories` (`id`);

--
-- Constraints for table `examseries_data`
--
ALTER TABLE `examseries_data`
  ADD CONSTRAINT `examseries_data_ibfk_1` FOREIGN KEY (`examseries_id`) REFERENCES `examseries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examseries_data_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `examtoppers`
--
ALTER TABLE `examtoppers`
  ADD CONSTRAINT `examtoppers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examtoppers_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `examtoppers_ibfk_3` FOREIGN KEY (`quiz_result_id`) REFERENCES `quizresults` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lmscontents`
--
ALTER TABLE `lmscontents`
  ADD CONSTRAINT `lmscontents_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `lmsseries`
--
ALTER TABLE `lmsseries`
  ADD CONSTRAINT `lmsseries_ibfk_1` FOREIGN KEY (`lms_category_id`) REFERENCES `lmscategories` (`id`);

--
-- Constraints for table `lmsseries_data`
--
ALTER TABLE `lmsseries_data`
  ADD CONSTRAINT `lmsseries_data_ibfk_1` FOREIGN KEY (`lmsseries_id`) REFERENCES `lmsseries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lmsseries_data_ibfk_2` FOREIGN KEY (`lmscontent_id`) REFERENCES `lmscontents` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questionbank`
--
ALTER TABLE `questionbank`
  ADD CONSTRAINT `questionbank_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `questionbank_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`);

--
-- Constraints for table `questionbank_quizzes`
--
ALTER TABLE `questionbank_quizzes`
  ADD CONSTRAINT `questionbank_quizzes_ibfk_1` FOREIGN KEY (`questionbank_id`) REFERENCES `questionbank` (`id`),
  ADD CONSTRAINT `questionbank_quizzes_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `questionbank_quizzes_ibfk_3` FOREIGN KEY (`quize_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quizresults`
--
ALTER TABLE `quizresults`
  ADD CONSTRAINT `quizresults_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `quizresults_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `quizcategories` (`id`),
  ADD CONSTRAINT `quizzes_ibfk_2` FOREIGN KEY (`instructions_page_id`) REFERENCES `instructions` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
