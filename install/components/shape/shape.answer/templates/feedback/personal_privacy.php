<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

if ($arParams['POLZOVATELSKOE_SOGLASHENIE_PAGE'] && $arParams['POLITIKA_KONFIDENCIALNOSTI_PAGE']) {
	?>
    <div class="av-comments__personal-privacy">
		<?= GetMessage(
			"SHAPE_ANSWER_PERSONAL_PRIVACY_TEXT",
			Array(
				'#POLZOVATELSKOE_SOGLASHENIE_PAGE#' => $arParams['POLZOVATELSKOE_SOGLASHENIE_PAGE'],
				'#POLITIKA_KONFIDENCIALNOSTI_PAGE#' => $arParams['POLITIKA_KONFIDENCIALNOSTI_PAGE'],
			)
		) ?>
    </div>
<? } ?>