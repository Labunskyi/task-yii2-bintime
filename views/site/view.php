<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-md-12">
			
                <h3>User</h3>
			
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>№</th>
				<th>Login</th>
				<th>Password</th>
				<th>Name</th>
				<th>Surname</th>
				<th>Gender</th>
				<th>Create time</th>
				<th>Email</th>
				
			</tr>
		</thead>

		<?php 
		if (isset($user)) {
		$i = 1; foreach($user as $us)		
		{ ?>	
		<tr>
			<td><?=1?></td>
			<td><?=$us['login']?></td>
			<td><?=$us['password']?></td>
			<td><?=$us['name']?></td>
			<td><?=$us['surname']?></td>
			<td><?=$us['gender']?></td>
			<td><?=date('d-m-Y H:i', strtotime($us['create_time']))?></td>
			<td><?=$us['email']?></td>
		</tr>
		<?php } }?>
	</table>
	<h3>Address</h3>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>№</th>
				<th>Post index</th>
				<th>Country</th>
				<th>City</th>
				<th>Street</th>
				<th>House</th>
				<th>Appartment</th>
				<th>Delete</th>

			</tr>
		</thead>

		<?php 
		if (isset($user)) {
		$k = 1; foreach($user as $us)
		foreach ($us['parcels'] as $address) 
		{ ?>	
		<tr>
			<td><?=$k++?></td>
			<td><?=$address['post_index']?></td>
			<td><?=$address['country']?></td>
			<td><?=$address['city']?></td>
			<td><?=$address['street']?></td>
			<td><?=$address['house']?></td>
			<td><? if ($address['appartment'] != '') {
						echo $address['appartment'];
					} else {
						echo 'n/a';
				}?>
			</td>
			
			<td><?= Html::a('Delete', ['site/delete-address', 'id' => $address['id']], ['class' => 'btn btn-sm btn-danger']) ?></td>

		</tr>
		<?php }
		}?>
	</table>
            </div>    
        </div>
    </div>
	
	<?= Html::a('Home', ['site/index'], ['class' => 'btn btn-sm btn-primary']) ?>
	
</div>
