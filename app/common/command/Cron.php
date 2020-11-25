<?php
// +----------------------------------------------------------------------
// | AcShop (Acgice商城)
// +----------------------------------------------------------------------
// | 团队官网: https://oauth.acgice.com
// +----------------------------------------------------------------------
// | 联系我们: https://oauth.acgice.com/sdk/contact.html
// +----------------------------------------------------------------------
// | gitee开源项目：https://gitee.com/orzice/acshop
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/orzice/acshop
// +----------------------------------------------------------------------
// | Author：Orzice(小涛)  https://gitee.com/orzice
// +----------------------------------------------------------------------
// | DateTime：2020-10-19 14:55:40
// +----------------------------------------------------------------------
// php think cron
namespace app\common\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

use think\facade\Event;
use app\common\Plugins;

class Cron extends Command
{
    /**
     * @static
     * @var array Saves all the cron jobs
     */
    private static $cronJobs = array();


    protected function configure()
    {
        $this->setName('cron')
            ->setDescription('系统计划任务服务（By：Orzice）');
    }

    protected function execute(Input $input, Output $output)
    {
        $output->writeln("");
        $output->writeln("---".date('Y-m-d H:i:s')."---");
        Plugins::init();
        $output->writeln("定时任务服务启动" );
        $output->writeln("");

        Event::trigger('cron.collectJobs');

        $report = \AcgCron\Cron::run();

        if($report['inTime'] === -1) {
            $inTime = -1;
        } else if ($report['inTime']) {
            $inTime = 'true';
        } else {
            $inTime = 'false';
        }

        $output->writeln("");
        $output->writeln("---".date('Y-m-d H:i:s')."---");
        $output->writeln("Run date :" .$report['rundate']);
        $output->writeln("In time :" .$inTime);
        $output->writeln("Run time :" .round($report['runtime'], 4));
        $output->writeln("Errors :" .$report['errors']);
        $output->writeln("Jobs :" .count($report['crons']));
        $output->writeln("-------------------------");

    }

}