<?php get_header();/* Template Name: MultiTestPage*/?>


<!-- donde buscar en consulta:
motivo consulta
antecedentes
diagnostico
plan tratamiento


palabras:
hipertiroidismo
hipotiroidismo
amenorrea
diabetes, dbt, diabetica
aborto, abortos
hormonas, hormona
ovario, poliquistico
sop

array('hipertiroidismo', 'hipotiroidismo', 'amenorrea', 'diabetes', 'dbt', 'diabetica', 'aborto', 'abortos', 'sop', 'hormonas', 'hormona', 'ovario', 'poliquistico'),

 -->

 <h2>Consultas</h2>

<?php 

$search_words = array('hipertiroidismo', 'hipotiroidismo', 'amenorrea', 'diabetes', 'dbt', 'diabetica', 'aborto', 'abortos', 'sop', 'hormonas', 'hormona', 'ovario', 'poliquistico');

foreach ($search_words as $key => $value) {
  
  $posts = get_posts(array(
    'numberposts'	=> -1,
    'post_type'		=> 'sw_consulta',
    'meta_query'	=> array(
      'relation'		=> 'OR',
      array(
        'key'	 	=> 'motivo_de_consulta',
        'value'	  	=> $value,
        'compare' 	=> 'LIKE',
      ),
      array(
        'key'	  	=> 'antecedente_actual',
        'value'	  	=> $value,
        'compare' 	=> 'LIKE',
      ),
      array(
        'key'	  	=> 'diagnostico_consulta',
        'value'	  	=> $value,
        'compare' 	=> 'LIKE',
      ),
      array(
        'key'	  	=> 'plan_tratamiento',
        'value'	  	=> $value,
        'compare' 	=> 'LIKE',
      ),
    ),
  ));
  

  if( $posts ): ?>



    <ul>
      
    <?php foreach( $posts as $post ): 
      
      setup_postdata( $post );
      
      ?>
      <li>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </li>
    
    <?php endforeach; ?>
    
    </ul>
    
    <?php wp_reset_postdata(); ?>
  
  <?php endif; 
  }  
  ?>











<!--  ---------------------------------- --------------------    AGO -->

<!-- observaciones 
las mismas -->


<h2>AGO</h2>

<?php 

// $search_words = array('hipertiroidismo', 'hipotiroidismo', 'amenorrea', 'diabetes', 'dbt', 'diabetica', 'aborto', 'abortos', 'sop', 'hormonas', 'hormona', 'ovario', 'poliquistico');

foreach ($search_words as $key => $value) {
  
  $posts = get_posts(array(
    'numberposts'	=> -1,
    'post_type'		=> 'sw_static_data',
    'meta_query'	=> array(
      // 'relation'		=> 'OR',
      array(
        'key'	 	=> 'observaciones',
        'value'	  	=> $value,
        'compare' 	=> 'LIKE',
      )
    ),
  ));
  

  if( $posts ): ?>



    <ul>
      
    <?php foreach( $posts as $post ): 
      
      setup_postdata( $post );
      
      ?>
      <li>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </li>
    
    <?php endforeach; ?>
    
    </ul>
    
    <?php wp_reset_postdata(); ?>
  
  <?php endif; 
  }  
  ?>

<?php get_footer(); ?>

