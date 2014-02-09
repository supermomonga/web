# coding=utf-8
# {{{ contrib
class ContribScss
  # @param [Hash] options
  #   src:   [String]   Source directory. Required.
  #   dest:  [String]   Destination directory. Default is equal to :src.
  #   style: [String]   Output style. Default is 'normal'.
  #   all:   [String[]] Scss files. Default is [].
  def initialize options
    @src = options[:src]
    raise ':src is required.' unless @src
    @dest = options[:dest] || @src
    @style = options[:style] || 'normal'
    @all = options[:all] || []
  end

  def to_proc
    lambda{|t, p|
      @all.each do |f|
        puts "Generating #{f}.css..."
        system "scss --style=#{@style} #{@src}/#{f}.scss #{@dest}/#{f}.css"
      end
    }
  end
end
# }}} contrib

require 'json'

desc 'Build SCSS files.'
task :scss, &ContribScss.new(src: 'assets/stylesheets', all: %w{layout})

desc 'Generate site navigation.'
task :gen_nav do
  nav = gather_navs File.absolute_path('templates')
  File.new('templates/nav.json', 'w:utf-8').write nav.to_json
  puts 'Generate navigation at templates/nav.json'
end

desc 'Pull master repository.'
task :deploy do
  require 'net/ssh'

  host = 'ranyuen.sakura.ne.jp'
  user = 'ranyuen'
  print "Enter SSH password (#{user}@#{host}): "
  password = $stdin.gets.chomp
  Net::SSH.start host, user, password: password do |ssh|
    puts ssh.exec!('cd $HOME/www && git pull origin master > logs/deploy.log && cat logs/deploy.log')
  end
end

desc 'Build files.'
task :build => [:scss, :gen_nav]

def gather_navs dir
  def get_title content
    return '' unless content =~ /^---/
    (content.lines.find{|line| line =~ /^title\s*:/ } || 'title:').
      match(/^title\s*:\s*(.*)$/)[1].chomp
  end

  def basename filename
    File.basename filename, File.extname(filename)
  end

  cwd = File.absolute_path '.'
  nav = {}
  Dir.chdir dir
  Dir.foreach '.' do |f|
    next if f == '.' || f == '..'
    if File.directory? f
      sub_nav = gather_navs File.absolute_path(f)
      sub_nav.each do |lang, n|
        nav[lang] ||= {}
        nav[lang][f] = n
      end
    elsif File.file?(f) && File.extname(f) == '.markdown'
      title = get_title File.open(f, 'r:utf-8').read
      f = basename f
      lang = (f.match(/\.([^.]+)$/) || [])[1] || 'default'
      nav[lang] ||= {}
      nav[lang][basename f] = title
    end
  end
  Dir.chdir cwd
  nav
end
# vim:set fdm=marker:
