<h1> Liste des discussions </h1>
<a href="?module=Discussions&action=new" class="btn btn-default btn-lg btn-block"><span class="glyphicon glyphicon-plus"></span> Nouvelle Discussion</a>
{foreach from=$discussions item=discussion}   
    <div class="discussion">
        <div class="titre">
            <h3><a href="?module=Discussions&action=view&id={$discussion->id_disc}">{$discussion->titre}</a></h3>
        </div>
        <div class="auteur">
            <p>
                Lancé par : <a href="?module=Utilisateur&action=view&id={$discussion->id_auteur_disc}">{$discussion->pseudo_auteur}</a>
            </p>
        </div>
        <div class="tag">
            <p>
                taggé comme : <a href="?module=Discussions&action=fromTag&id={$discussion->id_tag_disc}">{$discussion->nom_tag}</a>
            </p>
        </div>
    </div>
{/foreach}
<div style='clear:both'></div>