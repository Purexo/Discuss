{if ($user)}
    <div class="user">
        <p>Pseudo : <a href="#">{$user->pseudo}</a></p>
        <p>Email : {$user->email}</p>
    </div>
{else}
<p>Pas d'Utilisateur trouvé à cet ID</p>
{/if}
<div style='clear:both'></div>