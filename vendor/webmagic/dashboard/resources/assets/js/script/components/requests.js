/**
 * Use for multi field added
 *
 * @type {{add: Function, remove: Function}}
 */
fields = {

	/** Current count of elements */
	nex_item_name_postfix: 0,

	src_selector: '',

	dest_selector: '',

	item_selector: '',

	remove_btn_selector: '',

	add_btn_selector: '',

	/**
	 * Object init
	 * @param options
	 */
	init: function (options) {
		this.configure(options);
		this.init_next_item_name();
		this.init_controls();
	},

	/**
	 * Initializing controls
	 */
	init_controls: function(){
		var obj = this;

		$('body')
			.on('click', this.remove_btn_selector, function(){
				obj.remove(this);
			})
		.on('click', this.add_btn_selector, function(){
				obj.add();
			});
	},

	/**
	 * Counting current items
	 */
	init_next_item_name: function(){
		this.nex_item_name_postfix = $(this.dest_selector).find(this.item_selector).length;
	},

	/**
	 * Configure object with options
	 *
	 * @param options
	 */
	configure: function(options){
		var defaults = {
			src: '.js-src',
			dest: '.js-copy-dest',
			item: '.js-copy-item',
			add_btn:  '.js-add',
			remove_btn: '.js-remove'
		};

		var settings = $.extend({}, defaults, options);

		this.src_selector = settings.src;
		this.dest_selector = settings.dest;
		this.item_selector = settings.item;
		this.remove_btn_selector = settings.remove_btn;
		this.add_btn_selector = settings.add_btn;
	},


	/**
	 * Remove item
	 * @param control Control that was clicked
	 */
	remove: function(control) {
		$(control).closest(this.item_selector).remove();
	},

	/**
	 * Add new item
	 */
	add: function () {
		var obj = this;

		var new_el = $(this.src_selector).find(this.item_selector).clone();

		var el_inputs = new_el.find(':input');

		el_inputs.each(function(i, el) {
			var attr = $(el).attr('name');
			$(el).attr('name', attr + '_' + obj.nex_item_name_postfix)
		});

		new_el.appendTo(this.dest_selector);

		this.nex_item_name_postfix++;
	}
};