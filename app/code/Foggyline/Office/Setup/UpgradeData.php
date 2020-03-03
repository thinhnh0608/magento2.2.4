<?php
namespace Foggyline\Office\Setup;

use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface{
    protected $employeeFactory;
    protected $departmentFactory;
    private $employeeSetupFactory;

    public function __construct(
        \Foggyline\Office\Model\EmployeeFactory $employeeFactory,
        \Foggyline\Office\Model\DepartmentFactory $departmentFactory,
        \Foggyline\Office\Setup\EmployeeSetupFactory $employSetupFactory
    ){
        $this->employeeFactory = $employeeFactory;
        $this->departmentFactory = $departmentFactory;
        $this->employeeSetupFactory = $employSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        // TODO: Implement upgrade() method.
        try {
            //Update data for department table
            $salesDepartment = $this->departmentFactory->create();
            $salesDepartment->setName('Sales');
            $salesDepartment->save();

            //Update data for employee table
            $employee = $this->employeeFactory->create();
            $employee->setDepartmentId($salesDepartment->getId());
            $employee->setEmail('thinhnh@gmail.com');
            $employee->setFirstName('Nguyen Huu');
            $employee->setLastName('Thinh');
            $employee->setServiceYear('2');
            $employee->setDob('1985-08-06');
            $employee->setSalary('1000.00');
            $employee->setVatNumber('12345678910');
            $employee->setNote('Only note about thinh');
            $employee->save();
        }catch (\Exception $e) {
            echo $e->getMessage();
        }

        $setup->endSetup();
    }
}
