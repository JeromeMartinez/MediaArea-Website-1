<?php

namespace AppBundle\Lib\DownloadInfo;

use DeviceDetector\Parser\OperatingSystem as OSParser;

class DownloadInfo
{
    protected $supportedOS = array(
        'Arch Linux' => array('name' => 'Arch Linux', 'route' => 'mi_download_archlinux', 'installer' => false),
        'CentOS' => array('name' => 'CentOS', 'route' => 'mi_download_centos', 'installer' => false),
        'Debian' => array('name' => 'Debian', 'route' => 'mi_download_debian', 'installer' => false),
        'Fedora' => array('name' => 'Fedora', 'route' => 'mi_download_fedora', 'installer' => false),
        'Kubuntu' => array('name' => 'Ubuntu', 'route' => 'mi_download_ubuntu', 'installer' => false),
        'Lubuntu' => array('name' => 'Ubuntu', 'route' => 'mi_download_ubuntu', 'installer' => false),
        'Mac' => array('name' => 'Mac OS', 'route' => 'mi_download_mac', 'installer' => true),
        'Mandriva' => array('name' => 'Mandriva', 'route' => 'mi_download_mandriva', 'installer' => false),
        'Mint' => array('name' => 'Linux Mint', 'route' => 'mi_download_ubuntu', 'installer' => false),
        'Red Hat' => array('name' => 'RHEL', 'route' => 'mi_download_rhel', 'installer' => false),
        'SUSE' => array('name' => 'openSUSE', 'route' => 'mi_download_opensuse', 'installer' => false),
        'Slackware' => array('name' => 'Slackware', 'route' => 'mi_download_slackware', 'installer' => false),
        'Solaris' => array('name' => 'Solaris', 'route' => 'mi_download_solaris', 'installer' => false),
        'Ubuntu' => array('name' => 'Ubuntu', 'route' => 'mi_download_ubuntu', 'installer' => false),
        'Windows' => array('name' => 'Windows', 'route' => 'mi_download_windows', 'installer' => true),
        'Xubuntu' => array('name' => 'Ubuntu', 'route' => 'mi_download_ubuntu', 'installer' => false),
    );
    protected $userAgent;
    protected $downloadInfo;

    protected function detectOS()
    {
        $osParser = new OSParser();
        $osParser->setUserAgent($this->userAgent);
        $detectedOS = $osParser->parse();

        if ($detectedOS && array_key_exists($detectedOS['name'], $this->supportedOS)) {
            return $this->supportedOS[$detectedOS['name']];
        }

        return array('name' => false, 'route' => 'mi_download', 'installer' => false);
    }

    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    public function parse()
    {
        $this->downloadInfo = $this->detectOS();
        $this->downloadInfo['version'] = '0.7.96';
    }

    public function getName()
    {
        return $this->downloadInfo['name'];
    }

    public function getRoute()
    {
        return $this->downloadInfo['route'];
    }

    public function getInstaller()
    {
        return $this->downloadInfo['installer'];
    }

    public function getVersion()
    {
        return $this->downloadInfo['version'];
    }
}
