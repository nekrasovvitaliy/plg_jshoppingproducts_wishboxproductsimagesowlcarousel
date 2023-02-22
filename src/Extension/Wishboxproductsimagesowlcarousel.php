<?php
	/**
	 * @package     Joomla.Plugins
	 * @subpackage  Jshoppingproducts.Wishboxproductsimagesowlcarousel
	 */

	namespace Joomla\Plugin\Jshoppingproducts\Wishboxproductsimagesowlcarousel\Extension;
	
	// 
	use Exception;
	use \Joomla\CMS\Factory;
	use \Joomla\CMS\Layout\FileLayout;
	use \Joomla\CMS\Plugin\CMSPlugin;
	use \Joomla\Event\DispatcherInterface;
	use \Joomla\Event\SubscriberInterface;

	// phpcs:disable PSR1.Files.SideEffects
	\defined('_JEXEC') or die;
	// phpcs:enable PSR1.Files.SideEffects

	/**
	 *
	 */
	final class Wishboxproductsimagesowlcarousel extends CMSPlugin implements SubscriberInterface
	{
		/**
		 * Autoload the language file.
		 *
		 * @var boolean
		 * @since 4.1.0
		 */
		protected $autoloadLanguage = true;
		

		/**
		 * @inheritDoc
		 *
		 * @return string[]
		 *
		 * @since 4.1.0
		 */
		public static function getSubscribedEvents(): array
		{
			// 
			// 
			return [
						'onBeforeDisplayProductView'					=> 'onBeforeDisplayProductView',
						'onBeforeDisplayProductViewBlockImageMiddle'	=> 'onBeforeDisplayProductViewBlockImageMiddle',
						'onBeforeDisplayProductViewBlockImageThumb'		=> 'onBeforeDisplayProductViewBlockImageThumb'
					];
		}

		/**
		 * Constructor.
		 *
		 * @param   DispatcherInterface  $dispatcher  The dispatcher
		 * @param   array                $config      An optional associative array of configuration settings
		 *
		 * @since   4.2.0
		 */
		public function __construct(DispatcherInterface $dispatcher, array $config)
		{
			// 
			// 
			parent::__construct($dispatcher, $config);
		}
		
		
		/**
		 *
		 */
		public function onBeforeDisplayProductViewBlockImageMiddle(\Joomla\Event\Event $event)
		{
			// 
			// 
			$view = $event->getArgument(0);
			// 
			// 
			$this->addParentImages($view);
		}
		
		/**
		 *
		 */
		public function onBeforeDisplayProductViewBlockImageThumb(\Joomla\Event\Event $event)
		{
			// 
			// 
			$view = $event->getArgument(0);
			// 
			// 
			$this->addParentImages($view);
		}
		
		
		/**
		 *
		 */
		protected function addParentImages(&$view)
		{
			
			// 
			// 
			$app = Factory::getApplication();
			// 
			// 
			$controller = $app->input->get('controller', '');
			// 
			// 
			$task = $app->input->get('task', '');
			// 
			// 
			if ($controller == 'product' && $task == 'ajax_attrib_select_and_price')
			{
				// 
				// 
				$product_id = $view->images[0]->product_id;
				// 
				//
				$product_table = \JSFactory::getTable('product');
				// 
				//
				$product_table->load($product_id);
				// 
				// 
				if ($parent_id = $product_table->parent_id)
				{
					// 
					//
					$product_table->load($parent_id);
					// 
					// 
					$parent_images = $product_table->getImages();
					// 
					// 
					$view->images = array_merge($view->images, $parent_images);
				}
			}
		}
		

		/**
		 * @param   ExecuteTaskEvent  $event  The onExecuteTask event
		 *
		 * @return void
		 *
		 * @since 4.1.0
		 * @throws Exception
		 */
		public function onBeforeDisplayProductView(\Joomla\Event\Event $event): void
		{
			// 
			// 
			$view = $event->getArgument(0);
			// 
			// 
			$layoutData = [
							'config'       => $view->config,
							'images'       => $view->images,
							'plugin'       => $this,
							'pluginParams' => $this->params,
						];
			// 
			// 
			$layout = $this->params->get('layout');
			// 
			// 
			$view->_tmp_product_html_start .= $this->getRenderer($layout)->render($layoutData);
		}
		

		/**
		 * Get the layout paths
		 *
		 * @return  array
		 *
		 * @since   3.5
		 */
		protected function getLayoutPaths()
		{
			// 
			// 
			$template = Factory::getApplication()->getTemplate();
			// 
			// 
			return [
						JPATH_SITE.'/templates/'.$template.'/html/layouts/plugins/'.$this->_type.'/'.$this->_name,
						JPATH_SITE.'/plugins/'.$this->_type.'/'.$this->_name.'/layouts',
					];
		}

		/**
		 * Get the plugin renderer
		 *
		 * @param   string  $layoutId  Layout identifier
		 *
		 * @return  \Joomla\CMS\Layout\LayoutInterface
		 *
		 * @since   3.5
		 */
		protected function getRenderer($layoutId = 'default')
		{
			// 
			// 
			$renderer = new FileLayout($layoutId);
			// 
			// 
			$renderer->setIncludePaths($this->getLayoutPaths());
			// 
			// 
			return $renderer;
		}
	}