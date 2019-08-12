<?php $__env->startSection('header_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="<?php echo e(PREFIX); ?>"><i class="mdi mdi-home"></i></a> </li>
							<li><a href="<?php echo e(URL_THEMES_LIST); ?>"><?php echo e(getPhrase('themes')); ?></a>  </li>
							<li><?php echo e($title); ?></li>
						</ol>
					</div>
				</div>
								
				<!-- /.row -->
				<div class="panel panel-custom col-lg-12">
					<div class="panel-heading">
						
					<div class="pull-right messages-buttons">
								 
							 
						</div>
						<h1><?php echo e($title); ?>


						</h1>

					</div>
					<div class="panel-body packages">
				
					<?php echo Form::open(array('url' => URL_UPDATE_THEME_SUBSETTINGS.$record->slug, 'method' => 'POST', 
						'novalidate'=>'','name'=>'formSettings ', 'files'=>'true')); ?>

						<div class="row"> 
						<ul class="list-group">
						<?php if(count($settings_data)): ?>

						<?php $__currentLoopData = $settings_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php 
							$type_name = 'text';

							if($value->type == 'number' || $value->type == 'email' || $value->type=='password')
								$type_name = 'text';
							else
								$type_name = $value->type;
						?>
						 
						<?php echo $__env->make(
									'mastersettings.settings.sub-list-views.'.$type_name.'-type', 
									array('key'=>$key, 'value'=>$value)
								, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

							
								
						  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						  <?php else: ?>
							  <li class="list-group-item"><?php echo e(getPhrase('no_settings_available')); ?></li>
						  <?php endif; ?>
						</ul>

						<?php if($record->slug == 'theme_one'): ?>
                        
						<div class="row">
							 <div class="col-md-6">
							 	<img src="<?php echo e(IMAGES); ?>blue-header.jpg">
							 	<p><?php echo e(getPhrase('blue_header')); ?></p>
								<img src="<?php echo e(IMAGES); ?>blue-navbar.jpg">
							 	<p><?php echo e(getPhrase('blue_navigationbar')); ?></p>
							 </div>
								
							<div class="col-md-6">
								<img src="<?php echo e(IMAGES); ?>dark-header.jpg">
							 	<p><?php echo e(getPhrase('dark_header')); ?></p>
								<img src="<?php echo e(IMAGES); ?>dark-theme.jpg">
							 	<p><?php echo e(getPhrase('dark_theme')); ?></p>
							</div>
					   </div>
					   <?php endif; ?>	

						</div>

						<?php if(count($settings_data)): ?>
						<div class="buttons text-center clearfix">
							<button class="btn btn-lg btn-success button" ng-disabled='!formTopics.$valid'
							><?php echo e(getPhrase('update')); ?></button>
						</div>
						<?php endif; ?>
							<?php echo Form::close(); ?>

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
<?php $__env->stopSection(); ?>
 

<?php $__env->startSection('footer_scripts'); ?>
  
   <?php echo $__env->make('common.editor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <script src="<?php echo e(themes('js/bootstrap-toggle.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>