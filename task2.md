Search engine choose: Algolia

1. I decided to use Laravel 8, Algolia already has integration with it. 
2. Search requests always have priority over indexing operation
3. Already has UI ready

Example to find a casino from the model of Casinos

$query = 'Amazing Casino'; 
$casinos = App\Casinos::search($query)->get();