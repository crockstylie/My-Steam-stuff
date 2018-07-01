(function( $ ) {
	'use strict';
  $(document).ready(function () {

    console.log (mssSettingsArray);

    $('#mss-game-list').empty();
    var gridItemContentArray = [];
    var gridItemContent = '';
    var steamApiKey = mssSettingsArray['key'];
    var steamId = mssSettingsArray['steamid'];
    var steamApiformat = mssSettingsArray['format'];
    var includePlayedFreeGames = mssSettingsArray['include_played_free_games'];
    var includeAppInfo = mssSettingsArray['include_appinfo'];
    var steamApiUrl = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=' + steamApiKey + '&steamid=' + steamId + '&format=' + steamApiformat + '&include_played_free_games=' + includePlayedFreeGames + '&include_appinfo=' + includeAppInfo;
		$.getJSON(
      steamApiUrl,
      function (data) {
        $.each(data, function (key, val) {
          gridItemContentArray.push(val);
        });
        $.each(gridItemContentArray[0].games, function (key, val) {
          var gameTitle = gridItemContentArray[0].games[key].name;
          var appId = gridItemContentArray[0].games[key].appid;
          var imgIconUrl = gridItemContentArray[0].games[key].img_icon_url;
          var imgLogoUrl = gridItemContentArray[0].games[key].img_logo_url;
          gridItemContent += '<div class="grid-item"><div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">';
          gridItemContent += gameTitle;
          gridItemContent += '</h3></div><div class="panel-body">';
          if (imgLogoUrl.length > 0) {
            gridItemContent += '<img src="http://media.steampowered.com/steamcommunity/public/images/apps/';
            gridItemContent += appId;
            gridItemContent += '/';
            gridItemContent += imgLogoUrl;
            gridItemContent += '.jpg" alt="Image du jeu ';
            gridItemContent += gameTitle;
            gridItemContent += '" width="184" height="69">';
          }
          gridItemContent += '</div></div></div>';
        });
        $('#mss-game-list').append(gridItemContent);
      }
    );
	});
})( jQuery );