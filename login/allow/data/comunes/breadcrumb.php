<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
          <h4 class="page-title"><?php echo $paginaActual; ?></h4>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
          <ol class="breadcrumb">
			<?php

				$num=sizeof($breadcrumb);
				$n=0;
				while ($n<$num) {
					# code...
					if($n==($num-1))
					{
						echo '<li><a href="#" class="active">'.$breadcrumb[$n].'</a></li>';
					}
					else
					{
						echo '<li><a href="#" >'.$breadcrumb[$n].'</a></li>';
					}

					$n++;

				}
			?>
          </ol>
        </div>