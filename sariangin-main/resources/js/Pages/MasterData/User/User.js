import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-react";
import {
  Button,
  Card,
  Col,
  Input,
  Modal,
  Popover,
  Row,
  Space,
  Table,
} from "antd";
import { Delete, EditSquare, InfoCircle } from "react-iconly";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import { withTable } from "@/Pages/withTable";

const User = ({
  loading,
  dataSource,
  filters,
  pagination,
  handleSearch,
  handleChangeTable,
  getData,
}) => {
  const columns = [
    {
      title: "Nama",
      dataIndex: "name",
      key: "name",
      sorter: true,
    },
    {
      title: "Username",
      dataIndex: "username",
      key: "username",
      sorter: true,
    },
    {
      title: "Email",
      dataIndex: "email",
      key: "email",
      sorter: true,
    },
    {
      title: "Role",
      dataIndex: "role",
      key: "role",
      sorter: true,
      filters: filters && filters["roles"],
      render: (text, record) => record.role?.label,
    },
    {
      title: "Aksi",
      key: "actions",
      render: (text, record) => (
        <Space size="middle">
          <Popover content="Edit">
            <Link href={route(routes.USERS_EDIT, record.id)}>
              <Button
                type="default"
                icon={
                  <EditSquare
                    size="medium"
                    set="curved"
                    className="remix-icon"
                  />
                }
              />
            </Link>
          </Popover>
          <Popover content="Delete">
            <Button
              type="primary"
              ghost
              danger
              icon={
                <Delete size="medium" set="curved" className="remix-icon" />
              }
              onClick={handleClickDelete(record.id)}
            />
          </Popover>
        </Space>
      ),
    },
  ];

  const handleClickDelete = (id) => () => {
    const data = dataSource.find((data) => data.id === id);

    Modal.confirm({
      title: 'Hapus user "' + data.username + '"?',
      icon: <InfoCircle className="remix-icon" />,
      content: "Data user ini akan dihapus secara permanen.",
      onOk: () =>
        Inertia.delete(route(routes.USERS_DESTROY, id), {
          onSuccess: () => {
            getData();
          },
        }),
    });
  };

  return (
    <React.Fragment>
      <Row gutter={[0, 32]}>
        <Breadcrumbs breadcrumbs={[{ name: "Data Pengguna" }]} />
        <Col span={24}>
          <Card className="da-border-color-black-40">
            <Row gutter={[0, 32]}>
              <Col span={24}>
                <h4>Data Pengguna</h4>
                {/* <p className="da-p1-body">Master Data</p> */}
              </Col>

              <Row justify="space-between" className="da-w-100">
                <Col>
                  <Input placeholder="Search ..." onChange={handleSearch} />
                </Col>
                <Col>
                  <Button type="primary">
                    <Link href={route(routes.USERS_CREATE)}>Create</Link>
                  </Button>
                </Col>
              </Row>

              <Col span={24}>
                <Table
                  rowKey="id"
                  columns={columns}
                  dataSource={dataSource}
                  pagination={pagination}
                  loading={loading}
                  onChange={handleChangeTable}
                />
              </Col>
            </Row>
          </Card>
        </Col>
      </Row>
    </React.Fragment>
  );
};

export default withTable(User, {
  routeAjaxIndex: routes.USERS_AJAX_INDEX,
});
