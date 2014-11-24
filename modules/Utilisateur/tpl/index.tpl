{if ($users)}
<h1> Liste des Utilisateurs </h1>
    <div class="users">
{foreach from=$users item=user}
        <div class="user">
            <p>
                <a href="?module=Utilisateur&action=view&id={$user->id}">{$user->pseudo}</a>
            </p>
        </div>
{/foreach}
    </div>
{/if}
<div style='clear:both'></div>