<dl class="wide">
	<dt><label for="text">{lang}cms.acp.content.type.de.codequake.cms.content.type.template.text{/lang}</label></dt>
	<dd>
		<textarea id="text" rows="20" cols="40" name="contentData[text]">{if $contentData['text']|isset}{$contentData['text']}{/if}</textarea>
		<small>{lang}cms.acp.content.type.de.codequake.cms.content.type.template.text.description{/lang}</small>

		{include file='codemirror' codemirrorMode='smartymixed' codemirrorSelector='#text'}
		<script data-relocate="true" src="{@$__wcf->getPath()}js/3rdParty/codemirror/mode/xml/xml.js"></script>
		<script data-relocate="true" src="{@$__wcf->getPath()}js/3rdParty/codemirror/mode/smarty/smarty.js"></script>
		<script data-relocate="true" src="{@$__wcf->getPath()}js/3rdParty/codemirror/mode/css/css.js"></script>
		<script data-relocate="true" src="{@$__wcf->getPath()}js/3rdParty/codemirror/mode/javascript/javascript.js"></script>
		<script data-relocate="true" src="{@$__wcf->getPath()}js/3rdParty/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script data-relocate="true" src="{@$__wcf->getPath()}js/3rdParty/codemirror/mode/htmlembedded/htmlembedded.js"></script>
	</dd>
</dl>
