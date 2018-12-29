<?php
/*
	Question2Answer Markdown editor plugin
	License: http://www.gnu.org/licenses/gpl.html
*/

class qa_html_theme_layer extends qa_html_theme_base
{
	private $cssopt = 'md_editor_css';
	private $impuplopt = 'md_uploadimage';
	private $hljsopt = 'md_highlightjs';

	public function load_module($directory, $urltoroot)
	{
		$this->pluginurl = $urltoroot;
	}

	public function head_custom()
	{
		parent::head_custom();

		$hidecss = qa_opt($this->cssopt) === '1';
		$imageUploadEnabled = qa_opt($this->impuplopt) === '1';
		$usehljs = qa_opt($this->hljsopt) === '1';

		// display CSS for Markdown Editor
		if(!$hidecss){
			$this->output_raw("<link rel='stylesheet' href='".qa_html(QA_HTML_THEME_LAYER_URLTOROOT.'pagedown/markdown.css')."'>\n");
		}

		//limit page
		$tmpl = array('ask', 'question');
		if (!in_array($this->template, $tmpl))
			return;

		$this->output_raw(
			"<style>\n"
		);

		// set up imageUpload
		if (!$imageUploadEnabled) {
			$cssMD = '.te-popup-add-image .te-url-type{
						display: block;
					}
					.te-popup-add-image .te-tab-section,.te-popup-add-image form.te-file-type{
						display: none !important;
					}';
			$this->output_raw($cssMD);
		}

		$this->output_raw("</style>\n\n");

		// set up HighlightJS
		if ($usehljs) {
			$this->output_raw('<script>hljs.initHighlightingOnLoad();</script>');
		}
	}
}
