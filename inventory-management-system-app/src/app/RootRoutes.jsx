import React from 'react'
import { Redirect } from 'react-router-dom'
import dashboardRoutes from './dashboard/DashboardRoutes'
import attendanceRoutes from './views/attendance/AttendanceRoutes'
import brandRoutes from './views/brand/BrandRoutes'
import categoryRoutes from './views/category/CategoryRoutes'
import customerRoutes from './views/customer/CustomerRoutes'
import employeeRoutes from './views/employee/EmployeeRoutes'
import expenseRoutes from './views/expense/ExpenseRoutes'
import porintOfSaleRoutes from './views/pos/PointOfSaleRoutes'
import productRotues from './views/product/ProductRoutes'
import salaryRoutes from './views/salary/SalaryRoutes'
import supplierRoutes from './views/supplier/SupplierRoutes'

const redirectRoute = [
    {
        path: '/',
        exact: true,
        component: () => <Redirect to="/dashboard/default" />,
    },
]

const errorRoute = [
    {
        component: () => <Redirect to="/session/404" />,
    },
]

const routes = [
    ...dashboardRoutes,
    ...categoryRoutes,
    ...employeeRoutes,
    ...customerRoutes,
    ...supplierRoutes,
    ...salaryRoutes,
    ...expenseRoutes,
    ...attendanceRoutes,
    ...productRotues,
    ...porintOfSaleRoutes,
    ...brandRoutes,

    ...redirectRoute,
    ...errorRoute,
]

export default routes
