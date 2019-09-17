<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-md-12" style="min-height: 450px;">
                <h3>Users list</h3>
	<p>
        <?= Html::a('Add User', ['user/create'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>			
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
				<th>Address</th>
				<th>View</th>
				<th>Update</th>
				<th>Delete</th>
			</tr>
		</thead>
		<?php 
		if (isset($users)) {
		$i = 1; foreach($users as $user)		
		{ ?>	
		<tr>
			<td><?=$i++?></td>
			<td><?=$user['login']?></td>
			<td><?=$user['password']?></td>
			<td><?=$user['name']?></td>
			<td><?=$user['surname']?></td>
			<td><?=$user['gender']?></td>
			<td><?=date('d-m-Y H:i', strtotime($user['create_time']))?></td>
			<td><?=$user['email']?></td>
			<td><? $j = 1; foreach ($user['parcels'] as $address) {
					echo $j++ . '. ';
					echo $address['post_index'] . ', ';
					echo $address['country'] . ', ';
					echo $address['city'] . ', ';
					echo $address['street'] . ', ';
					echo $address['house'] . ', ';
					if ($address['appartment'] != '') {
						echo 'app. ' .$address['appartment'] . '; ' . '</br>';
					} else {
						echo 'app. ' . 'n/a' . '</br>';
					}
				
			}?></td>
			<td><?= Html::a('View', ['site/view', 'id' => $user['id']], ['class' => 'btn btn-sm btn-primary']) ?></td>
			<td><?= Html::a('Update', ['user/update', 'id' => $user['id']], ['class' => 'btn btn-sm btn-warning']) ?></td>
			<td><?= Html::a('Delete', ['site/delete', 'id' => $user['id']], ['class' => 'btn btn-sm btn-danger']) ?></td>
		</tr>
		<?php } }?>
	</table>
            </div> 
	<?php 
		
		echo \yii\widgets\LinkPager::widget([
			'pagination' => $pages,
		]);
	?>			
        </div>
		
    </div>
</div>
